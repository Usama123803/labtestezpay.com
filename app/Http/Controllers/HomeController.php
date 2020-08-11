<?php

namespace App\Http\Controllers;

use App\Country;
use App\Location;
use App\Patient;
use App\State;
use Carbon\Carbon;
use Illuminate\Http\Request;

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


        return view('pages.index', compact('states','countries','locations'));
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

}
