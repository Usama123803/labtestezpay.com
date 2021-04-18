<?php

namespace App\Http\Controllers;

use App\Configuration;
use App\Country;
use App\CovidSymptom;
use App\DocumentPatients;
use App\Helper\GeneralHelper;
use App\Location;
use App\Mail\PatientMailer;
use App\Patient;
use App\PatientAppointment;
use App\PatientCovidSymptom;
use App\State;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Crypt;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $countries = Country::where('status',1)->get();
        $states = State::where('status',1)->get();
        $locations = Location::where('status',1)->get();
        $covidSymptoms = CovidSymptom::where('status',1)->get();
        $disabledDates = $timeSlots = [];
        return view('pages.index', compact('states','countries','locations','timeSlots','disabledDates','covidSymptoms'));
    }

    /**
     * @param Request $request
     */
    public function storePatient(Request $request)
    {
        try {
            $full_name = $request->first_name. ' '. $request->last_name;
            $isExists = Patient::where(['full_name' => $full_name], ['dob' => $request->dob],
                ['email_address' => $request->email_address])->first();
            if(empty($isExists)) {
                $patient = new Patient;
                $patient->first_name        =   $request->first_name;
                $patient->last_name         =   $request->last_name;
                $patient->full_name         =   $request->first_name. ' '. $request->last_name;
                $patient->parent_name       =   $request->parent_name;
                $patient->relation_name     =   $request->relation_name;
                $patient->parent_checkbox   =   $request->parent_checkbox ? 1 : 0;
                $patient->email_address     =   $request->email_address;
                $patient->gender            =   $request->gender;
                $patient->dob               =   $request->dob;
                $patient->cell_phone        =   $request->cell_phone;
                $patient->created_at        =   date('Y-m-d h:i:s');
                $patient->save();
                $patient_id = $patient->id;
            }
            else {
                $patient_id = $isExists->id;
            }
            $patientAppointment = new PatientAppointment;
            $patientAppointment->timeslot = $request->timeslot;
            $patientAppointment->patient_id = $patient_id;
            $patientAppointment->hear_about = $request->hear_about;
            $patientAppointment->refer_name = $request->refer_name;
            $patientAppointment->result_type = $request->result_type;
            if (!empty($request->flight_datetime)) {
                $patientAppointment->flight_datetime = Carbon::parse($request->flight_datetime)->format('Y-m-d H:i:s');
            } else {
                $patientAppointment->flight_datetime = null;
            }

            $patientAppointment->front = null;
            if ($request->file('front_picture')) {
                $patientAppointment->front = GeneralHelper::uploadAttachment($request->file('front_picture'), 'front_picture');
            }
            $patientAppointment->back = null;
            if ($request->file('back_picture')) {
                $patientAppointment->back = GeneralHelper::uploadAttachment($request->file('back_picture'), 'back_picture');
            }

            $patientAppointment->paid_or_free      =   $request->paid_or_free;
            $patientAppointment->is_fax            =   $request->is_fax;
            $patientAppointment->fax               =   $request->fax;
            $patientAppointment->is_email          =   $request->is_email;
            $patientAppointment->email_cb          =   $request->email_cb;
            $patientAppointment->passcode          =   $request->passcode;
            $patientAppointment->group_no          =   $request->group_no;
            $patientAppointment->ins_name          =   $request->ins_name;
            $patientAppointment->bill_to           =   $request->bill_to;
            $patientAppointment->landline          =   $request->landline;
            $patientAppointment->zipcode           =   $request->zipcode;
            $patientAppointment->locationId        =   $request->locationId;
            $patientAppointment->appointment       =   $request->appointment;
            $patientAppointment->city              =   $request->city;
            $patientAppointment->address           =   $request->address;
            $patientAppointment->stateId           =   $request->stateId;
            $patientAppointment->terms             =   $request->terms;
            $patientAppointment->created_at        =   date('Y-m-d h:i:s');
            $patientAppointment->save();
            $covidSymptomData = [
                'covid_symptom_id' => $request->covidSymptoms,
                'patient_id' => $patient_id,
                'appointment_id' => $patientAppointment->id
            ];
//            if(!empty($request->covidSymptoms)){
//                foreach($request->covidSymptoms as $covidSymptom){
//                    $covidSymptomData[] = array('covid_symptom_id' => $covidSymptom,'patient_id' => $patient->id);
//                }
//            }
            if($covidSymptomData && count($covidSymptomData) > 0){
                PatientCovidSymptom::insert($covidSymptomData);
            }

            // To Send the email for confirmation appointment

//            $this->patientConfirmationEmail($patient_id);

            return redirect()->back()->with('success','Patient added successfully');
        }catch (\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function printPdf($id)
    {
        $random = time().rand(10,100);
        $url = 'patients/'.$random . '.pdf';
        $patientAppointment = PatientAppointment::find($id);
        $patient = $patientAppointment->patient;
        $documentPatient = DocumentPatients::where([['appointment_id', $id], ['type', 'appointment']])->first();
        if($documentPatient){
            return false;
//            return url('storage/'.$documentPatient->url);
        }

        $documentPatientArray = [
            'url' => $url,
            'patient_id' => $patientAppointment->patient_id,
            'appointment_id' => $patientAppointment->id,
            'type' => 'appointment',
        ];

//      Checkin while click on print pdf file
        if($patientAppointment->checkin == 0){
            $patientAppointment->checkin = 1;
            $patientAppointment->save();
        }
        $covidSymptoms = $patient->covidSymptoms->pluck('name')->implode(', ');
        $data = ['title' => 'Patient COVID-19 Report'];
        //date in mm/dd/yyyy format; or it can be in other formats as well
        $birthDate = Carbon::parse($patient->dob)->format('m/d/Y');
        $patientAppointment->flight_datetime = Carbon::parse($patientAppointment->flight_datetime)->format('m/d/Y H:i:s');
        $birthDate = explode("/", $birthDate);
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
            ? ((date("Y") - $birthDate[2]) - 1)
            : (date("Y") - $birthDate[2]));

        $data['age'] = $age;
        $data['dob_month'] = $birthDate[0];
        $data['dob_day'] = $birthDate[1];
        $data['dob_year'] = $birthDate[2];
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
            ->loadView('pdf.patient',compact('data','patient','covidSymptoms','patientAppointment'));

        DocumentPatients::create($documentPatientArray);
        Storage::put('public/'.$url, $pdf->output());
        return $pdf->stream();
    }

//    public function appointmentDate()
//    {
//        $date = $_GET['date'];
//        $date = Carbon::parse($date)->format('Y-m-d');
//        $start_time = config('site.start_time');
//        $end_time = config('site.end_time');
//        $time_interval = config('site.time_interval');
//        $block_start_time = new DateTime(config('site.block_start_time'));
//        $block_end_time = new DateTime(config('site.block_end_time'));
//        $begin = new DateTime($start_time);
//        $end   = new DateTime($end_time);
//        $interval = DateInterval::createFromDateString($time_interval.' min');
//        $times    = new DatePeriod($begin, $interval, $end);
//        $timeSlots = [];
//        $format = 'h:i'; // 12 Hours format and for 24 hours format H:i
//        foreach ($times as $time) {
//            if($time->format($format) >= $block_start_time->format($format) && $time->format($format) <= $block_end_time->format($format) ){
//                // you need to do something
//            }else{
//                $timeSlots[] = $time->format($format);
//            }
//        }
//        $timeSlots[] = $end->format($format);
//        $patientsTimeSlotCount = DB::table('patients')
//            ->select('timeslot', DB::raw('count(timeslot) as total'), DB::raw('DATE(created_at) as date'))
//            ->whereIn('timeslot',  $timeSlots)
//            ->whereDate('created_at', $date)
//            ->groupBy('timeslot')
//            ->get();
//
//        return \response()->json(['data'=> $patientsTimeSlotCount, 'timeSlots' =>  $timeSlots]);
//    }

    public function termsAndCondition($encryptLocationId)
    {
        $id = Crypt::decryptString($encryptLocationId);
        $location = Location::find($id);
        if(!$location && !$location->terms_and_condition){
            abort(404);
        }
        return view('pages.terms-and-condition',compact('location'));
    }

    public function locationById()
    {
        $locationId = $_GET['id'];
        $result = Location::find($locationId);

        $start_time = $result->start_time;
        $end_time = $result->end_time;
        $block_start_time = new DateTime($result->block_start_time);
        $block_end_time = new DateTime($result->block_end_time);
        $time_interval = $result->time_interval;
        $disabledAppointmentDates = $result->disabled_appointment_dates;
        $begin = new DateTime($start_time);
        $end   = new DateTime($end_time);
        $interval = DateInterval::createFromDateString($time_interval.' min');
        $times    = new DatePeriod($begin, $interval, $end);
        $timeSlots = [];
        $format = 'H:i'; // 12 Hours format and for 24 hours format H:i
        foreach ($times as $time) {
            if($time->format($format) >= $block_start_time->format($format) && $time->format($format) <= $block_end_time->format($format) ){
                // you need to do something
            }else{
                $timeSlots[] = $time->format($format);
            }
        }
        $timeSlots[] = $end->format($format);
//        $patientsTimeSlotCount = DB::table('patients')
        $patientsTimeSlotCount = DB::table('patient_appointments')
            ->select('timeslot', DB::raw('count(timeslot) as total'), DB::raw('DATE(created_at) as date'))
            ->whereIn('timeslot', $timeSlots)
            ->groupBy(['timeslot','date'])
            ->get();

        $patientsTimeSlotCount->map(function($element) use ($result) {
           return $element->total <= $result->block_limit ? $element->date : null;
        });

        $disabledDates = [];
        foreach($disabledAppointmentDates as $disabledAppointmentDate){
            $disabledDates[] =$disabledAppointmentDate['appointment_date'];
        }

        $timeSlotsOptions = '<option value="">Please Select Appointment Time</option>';
        foreach($timeSlots as $timeSlot):
            $displayTimeSlot = date("h:i a", strtotime($timeSlot));
            $timeSlotsOptions .= '<option value = "'.$timeSlot.'" > '.$displayTimeSlot.' </option>';
        endforeach;
        return \response()->json([
            "result"=> $result,
            "disabledDates"=> $disabledDates,
            "timeSlots"=> $timeSlots,
            "timeSlotsOptions"=> $timeSlotsOptions,
            "encryptedLocationId"=> Crypt::encryptString($result->id),
        ]);
    }

    public function patientConfirmationEmail($patientId)
    {
        $patient = Patient::where('id',$patientId)->first();
        $emailSubject = "Confirmation Email";
        $name = $patient->first_name.' '.$patient->last_name;
        $clientEmail = $patient->email_address;
//        $patient->timeslot = Carbon::parse($patient->timeslot)->format('h:i a');
        $timeslot = $patient->patientAppointment->timeslot;
        $timeslot = Carbon::parse($timeslot)->format('h:i a');
//        Mail::send('emails.patient-confirmation', compact("patient", "timeslot"), function ($m)
//        use ($emailSubject, $name, $clientEmail) {
//            $m->from(env('MAIL_FROM_ADDRESS', 'info@labwork360.com'), env('MAIL_FROM_NAME'));
//            $m->to($clientEmail, $name)->subject($emailSubject);
//        });
    }


}
