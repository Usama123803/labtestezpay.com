<?php

namespace App\Admin\Actions\Post;

use App\Mail\PatientReportMailer;
use Encore\Admin\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Storage;
use File;

class SendPatientEmail extends Action
{
    protected $selector = '.send-patient-email';

    public function handle(Request $request)
    {
        if($request->all()){
            $email = $request->get('email');
            $fileName = $this->uploadImage($request);
            $subject = 'Patient Report - '. date('Y-m-d');
            $message = 'Please check the below attachment';
            $response = Mail::to($email)->send(new PatientReportMailer($subject,$fileName,$message));
            if($response){
                Storage::disk('public')->delete('patients/'.$fileName);
            }
        }
        return $this->response()->success('Email is sent successfully')->refresh();
    }

    public function form()
    {
        $this->email('email', 'User Email')->rules('required');
        $this->file('file', 'Please select file')->rules('required|mimes:pdf,xlx,csv');
    }

    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-default send-patient-email">Send Patient Email</a>
HTML;
    }

    private function uploadImage($request){
        if($request){
            $fileName = time().'.'.$request->file->extension();
            Storage::disk('public')->putFileAs('patients', $request->file('file'), $fileName);
            return $fileName;
        }
        return null;
    }

    public function createDirectory()
    {
        //$path = public_path('patients');
        $path = 'patients';
//        if(!Storage::isDirectory($path)){
            Storage::makeDirectory($path, 0777, true, true);
//        }
    }

}
