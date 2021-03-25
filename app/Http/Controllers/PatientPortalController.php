<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientPortalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $patients = [];
        if($user){
            $patients = Patient::find($user->patient_id);
        }
//        $patientURL = $patient->documents[0]->url;
//        dd(public_path($patientURL));
        return view('pages.portal.index', compact('patients'));
    }

}
