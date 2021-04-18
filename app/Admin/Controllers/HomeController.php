<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\PatientMailer;
use App\Patient;
use App\PatientAppointment;
use App\Timesheet;
use App\User;
use Carbon\Carbon;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        $authUser = Auth::guard('admin')->user();
        $timesheet = Timesheet::whereDate('created_at', Carbon::today())->where('user_id',$authUser->id)->first();
        return $content
            ->title('Dashboard')
            ->description('Description...')
            ->view('pages.timesheet', compact('timesheet', 'authUser'));
    }

    public function patientEmail(Content $content, $id)
    {
        $patientAppointment = PatientAppointment::find($id);
        $patient = $patientAppointment->patient;
//        Mail::to($patient->email_address)->send(new PatientMailer($patient, $patientAppointment));
        $content->withSuccess('Email send successfully to '.$patient->first_name .' '.$patient->last_name, 'Email sent');
        return back();
    }

    public function patientLoginEmail(Content $content, $id)
    {
        if ($id) {
            $patientAppointment = PatientAppointment::find($id);
            $patient = $patientAppointment->patient;
            if ($patient) {
                $password = Carbon::parse($patient->dob)->format('Ydm');
                $alreadyExists = User::where('email', $patient->email_address)->first();
                if(!$alreadyExists){
                    User::create([
                        'name' => $patient->full_name,
                        'patient_id' => $patient->id,
                        'email' => $patient->email_address,
                        'password' => Hash::make($password),
                        'created_at' => date('Y-m-d h:i:s'),
                    ]);
                }
            }

            $subject = 'Login Credentials';
//            Mail::send('emails.patient-login', compact("patient","patientAppointment"), function ($m)
//            use ($subject, $patient) {
//                $m->from(env('MAIL_FROM_ADDRESS', 'info@labwork360.com'), env('MAIL_FROM_NAME'));
//                $m->to($patient->email_address, $patient->full_name)->subject($subject);
//            });
            $content->withSuccess('Email send successfully to '.$patient->full_name, 'Email sent');
        }else {
            $content->withError('Something went wrong while sending the email', '!!ERROR!!');
        }
        return back();
    }

    public function patientCheckIn(Content $content, $id)
    {
        //$patient = Patient::find($id);
        $patientAppointment = PatientAppointment::find($id);
        if($patientAppointment->checkin == 0){
            $patientAppointment->checkin = 1;
        }else{
            $patientAppointment->checkin = 0;
        }
        $patientAppointment->save();
        $content->withSuccess('Success', 'CheckIn status updated successfully of ' . $patientAppointment->patient->first_name . ' ' . $patientAppointment->patient->last_name);
        return back();
    }

}
