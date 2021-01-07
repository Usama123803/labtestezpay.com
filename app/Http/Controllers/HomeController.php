<?php

namespace App\Http\Controllers;

use App\Configuration;
use App\Country;
use App\CovidSymptom;
use App\Location;
use App\Mail\PatientMailer;
use App\Patient;
use App\PatientCovidSymptom;
use App\State;
//use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
//    protected $timeSlots = [];

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $countries = Country::where('status',1)->get();
        $states = State::where('status',1)->get();
        $locations = Location::where('status',1)->get();
        $covidSymptoms = CovidSymptom::where('status',1)->get();


        $start_time = config('site.start_time');
        $end_time = config('site.end_time');
        $block_start_time = new DateTime(config('site.block_start_time'));
        $block_end_time = new DateTime(config('site.block_end_time'));
        $time_interval = config('site.time_interval');
        $disabledAppointmentDates = config('site.disabled_appointment_dates');
        $begin = new DateTime($start_time);
        $end   = new DateTime($end_time);
        $interval = DateInterval::createFromDateString($time_interval.' min');
        $times    = new DatePeriod($begin, $interval, $end);
        $timeSlots = [];
        foreach ($times as $time) {
            if($time->format('H:i') >= $block_start_time->format('H:i') && $time->format('H:i') <= $block_end_time->format('H:i') ){
                // you need to do somthing
            }else{
                $timeSlots[] = $time->format('H:i');
            }
        }
        $timeSlots[] = $end->format('H:i');
        $patientsTimeSlotCount = DB::table('patients')
            ->select('timeslot', DB::raw('count(timeslot) as total'), DB::raw('DATE(created_at) as date'))
            ->whereIn('timeslot', $timeSlots)
            ->groupBy(['timeslot','date'])
            ->get();

        $patientsTimeSlotCount->map(function($element){
           return $element->total <=config('site.block_limit') ? $element->date : null;
        });

        $disabledDates = [];
        foreach($disabledAppointmentDates as $disabledAppointmentDate){
            $disabledDates[] =$disabledAppointmentDate['appointment_date'];
        }

        return view('pages.index', compact('states','countries','locations','timeSlots','disabledDates','covidSymptoms'));
    }
    public function patient()
    {
        $countries = Country::where('status',1)->get();
        $states = State::where('status',1)->get();
        $locations = Location::where('status',1)->get();

        return view('pages.patient', compact('states','countries','locations'));
    }

    /**
     * @param Request $request
     */
    public function storePatient(Request $request)
    {
//        dd($request->covidSymptoms);

        try {
            $patient = new Patient;
            $patient->first_name        =   $request->first_name;
            $patient->last_name         =   $request->last_name;
            $patient->email_address     =   $request->email_address;
            $patient->gender            =   $request->gender;
//            $patient->dob               =   Carbon::parse($request->dob)->format('Y-m-d');
            $patient->dob               =   $request->dob;
            $patient->cell_phone        =   $request->cell_phone;
            $patient->timeslot          =   $request->timeslot;
            $patient->hear_about        =   $request->hear_about;
            $patient->refer_name        =   $request->refer_name;
            $patient->result_type        =   $request->result_type;
            if(!empty($request->flight_datetime)){
                $patient->flight_datetime   =   Carbon::parse($request->flight_datetime)->format('Y-m-d H:i:s');
            }else{
                $patient->flight_datetime   = null;
            }
            $patient->paid_or_free      =   $request->paid_or_free;

            $patient->is_fax            =   $request->is_fax;
            $patient->fax               =   $request->fax;
            $patient->is_email          =   $request->is_email;
            $patient->email_cb          =   $request->email_cb;
            $patient->passcode          =   $request->passcode;
            $patient->group_no          =   $request->group_no;
            $patient->ins_name          =   $request->ins_name;
            $patient->bill_to           =   $request->bill_to;

            $patient->landline          =   $request->landline;
            $patient->zipcode           =   $request->zipcode;
//            $patient->countryId       =   $request->countryId;
            $patient->locationId        =   $request->locationId;
//            $patient->covid_symptoms_id =   $request->covid_symptoms_id;
//            $patient->appointment       =   Carbon::parse($request->appointment)->format('Y-m-d');
            $patient->appointment       =   $request->appointment;
            $patient->city              =   $request->city;
            $patient->address           =   $request->address;
            $patient->stateId           =   $request->stateId;
            $patient->terms             =   $request->terms;
            $patient->created_at        =   date('Y-m-d h:i:s');
            $patient->save();

            $covidSymptomData = [];
            if(!empty($request->covidSymptoms)){
                foreach($request->covidSymptoms as $covidSymptom){
                    $covidSymptomData[] = array('covid_symptom_id' => $covidSymptom,'patient_id' => $patient->id);
                }
            }
            if($covidSymptomData && count($covidSymptomData) > 0){
                PatientCovidSymptom::insert($covidSymptomData);
            }

            return redirect()->back()->with('success','Patient added successfully');
        }catch (\Exception $e){
            return redirect()->back()->with('error','Something went wrong while adding patient');
        }
    }

    public function printPdf($id)
    {
        $patient = Patient::find($id);
        $covidSymptoms = $patient->covidSymptoms->pluck('name')->implode(', ');

        $data = ['title' => 'Patient COVID-19 Report'];
        //date in mm/dd/yyyy format; or it can be in other formats as well
        $birthDate = Carbon::parse($patient->dob)->format('m/d/Y');
        $patient->flight_datetime = Carbon::parse($patient->flight_datetime)->format('m/d/Y H:i:s');
        //if($patient->flight_datetime){
          //  $patient->flight_datetime = Carbon::parse($patient->flight_datetime)->format('m/d/Y H:i:s');
        //}{
          //  $patient->flight_datetime = null;
        //}
        $birthDate = explode("/", $birthDate);
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
            ? ((date("Y") - $birthDate[2]) - 1)
            : (date("Y") - $birthDate[2]));

        $data['age'] = $age;
        $data['dob_month'] = $birthDate[0];
        $data['dob_day'] = $birthDate[1];
        $data['dob_year'] = $birthDate[2];



        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
            ->loadView('pdf.patient',compact('data','patient','covidSymptoms'));
        return $pdf->stream();
//        return $pdf->download('patient.pdf');
//        return view('pdf.patient',compact('data','patient'));
    }

    public function appointmentDate()
    {
        $date = $_GET['date'];
        $date = Carbon::parse($date)->format('Y-m-d');
        $start_time = config('site.start_time');
        $end_time = config('site.end_time');
        $time_interval = config('site.time_interval');
        $block_start_time = new DateTime(config('site.block_start_time'));
        $block_end_time = new DateTime(config('site.block_end_time'));
        $begin = new DateTime($start_time);
        $end   = new DateTime($end_time);
        $interval = DateInterval::createFromDateString($time_interval.' min');
        $times    = new DatePeriod($begin, $interval, $end);
        $timeSlots = [];
        foreach ($times as $time) {
            if($time->format('H:i') >= $block_start_time->format('H:i') && $time->format('H:i') <= $block_end_time->format('H:i') ){
                // you need to do somthing
            }else{
                $timeSlots[] = $time->format('H:i');
            }
        }
        $timeSlots[] = $end->format('H:i');
//        $timeSlots = ['09:00am','09:15am','09:30am','09:45am','10:00am','10:15am','10:30am','10:45am','11:00am','11:15am','11:30am','11:45am','12:00pm','12:15pm','12:30pm','12:45pm','02:00pm','02:15pm','02:30pm','02:45pm','03:00pm','03:15pm','03:30pm','03:45pm','04:00pm','04:15pm','04:30pm','04:45pm','05:00pm'];
        $patientsTimeSlotCount = DB::table('patients')
            ->select('timeslot', DB::raw('count(timeslot) as total'), DB::raw('DATE(created_at) as date'))
            ->whereIn('timeslot',  $timeSlots)
            ->whereDate('created_at', $date)
            ->groupBy('timeslot')
            ->get();

        return \response()->json(['data'=> $patientsTimeSlotCount, 'timeSlots' =>  $timeSlots]);

    }

    public function termsAndCondition()
    {
        return view('pages.terms-and-condition');
    }

    public function locationById()
    {
        $locationId = $_GET['id'];
        $result = Location::find($locationId);
        return \response()->json($result);
    }

    public function patientConfirmationEmail($patient)
    {
        $emailSubject = "Confirmation Email";
        $name = $patient->first_name.' '.$patient->last_name;
        $clientEmail = $patient->email;
        Mail::send('emails.patient-confirmation', compact("patient"),function ($m) use ($emailSubject, $name, $clientEmail){
            $m->from(config('site.from_email'), config('site.company_name'));
            $m->to($clientEmail, $name)->subject($emailSubject);
            $m->bcc(config('site.contact_email'));
        });
    }


}
