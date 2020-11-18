<?php

namespace App\Http\Controllers;

use App\Country;
use App\Location;
use App\Mail\PatientMailer;
use App\Patient;
use App\State;
//use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
        $timeSlots = ['09:00am','09:15am','09:30am','09:45am','10:00am','10:15am','10:30am','10:45am','11:00am','11:15am','11:30am','11:45am','12:00pm','12:15pm','12:30pm','12:45pm','01:00pm','01:15pm','01:30pm','01:45pm','02:00pm','02:15pm','02:30pm','02:45pm','03:00pm','03:15pm','03:30pm','03:45pm','04:00pm','04:15pm','04:30pm','04:45pm','05:00pm'];

        $patientsTimeSlotCount = DB::table('patients')
            ->select('timeslot', DB::raw('count(timeslot) as total'), DB::raw('DATE(created_at) as date'))
            ->whereIn('timeslot', $timeSlots)
            ->groupBy(['timeslot','date'])
            ->get();

        $res = $patientsTimeSlotCount->map(function($element){
           return $element->total <=3 ? $element->date : null;
        });


//        dd($res);

        return view('pages.index', compact('states','countries','locations','timeSlots'));
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
        try {
            $patient = new Patient;
            $patient->first_name        =   $request->first_name;
            $patient->last_name         =   $request->last_name;
            $patient->email_address     =   $request->email_address;
            $patient->gender            =   $request->gender;
            $patient->dob               =   Carbon::parse($request->dob)->format('Y-m-d');;
            $patient->cell_phone        =   $request->cell_phone;
            $patient->timeslot          =   $request->timeslot;
            $patient->hear_about        =   $request->hear_about;

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
//            $patient->countryId         =   $request->countryId;
            $patient->locationId        =   $request->locationId;
            $patient->appointment       =   Carbon::parse($request->appointment)->format('Y-m-d H:i:s');
            $patient->city              =   $request->city;
            $patient->address           =   $request->address;
            $patient->stateId           =   $request->stateId;
            $patient->terms             =   $request->terms;
            $patient->created_at        =   date('Y-m-d h:i:s');
            $patient->save();

//            dd($request->all());

            return redirect()->back()->with('success','Patient added successfully');
        }catch (\Exception $e){
            return redirect()->back()->with('error','Something went wrong while adding patient');
        }
    }

    public function printPdf($id)
    {
        $patient = Patient::find($id);
        $data = ['title' => 'Patient COVID-19 Report'];
        //date in mm/dd/yyyy format; or it can be in other formats as well
        $birthDate = Carbon::parse($patient->dob)->format('m/d/Y');
        $birthDate = explode("/", $birthDate);
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
            ? ((date("Y") - $birthDate[2]) - 1)
            : (date("Y") - $birthDate[2]));

        $data['age'] = $age;
        $data['dob_month'] = $birthDate[0];
        $data['dob_day'] = $birthDate[1];
        $data['dob_year'] = $birthDate[2];



        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdf.patient',compact('data','patient'));
        return $pdf->stream();
//        return $pdf->download('patient.pdf');
//        return view('pdf.patient',compact('data','patient'));
    }

    public function appointmentDate()
    {
        $date = $_GET['date'];
        $date = Carbon::parse($date)->format('Y-m-d');
        $timeSlots = ['08:30','09:15','10:00','10:45','11:30','12:15','13:00','13:45','14:30','15:15','16:00','16:45','17:30'];
        $patientsTimeSlotCount = DB::table('patients')
            ->select('timeslot', DB::raw('count(timeslot) as total'), DB::raw('DATE(created_at) as date'))
            ->whereIn('timeslot', $timeSlots)
            ->whereDate('created_at', $date)
            ->groupBy('timeslot')
            ->get();

        return \response()->json(['data'=> $patientsTimeSlotCount, 'timeSlots' => $timeSlots]);

    }

    public function termsAndCondition()
    {
        return view('pages.terms-and-condition');
    }

}
