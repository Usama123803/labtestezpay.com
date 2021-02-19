<?php

namespace App\Admin\Actions\Post;

use App\Mail\PatientReportMailer;
use Encore\Admin\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Storage;
use File;

class AttachPatientTestReport extends Action
{
    protected $selector = '.attach-patient-test-report';

    public $name = 'Upload Patient Test Report';

    public function handle(Request $request)
    {
        if($request->all()){

            dd($request->all());

//            $email = $request->get('email');
//            $fileName = $this->uploadImage($request);
//            $subject = 'Patient Report - '. date('Y-m-d');
//            $message = 'Please check the below attachment';
//            $response = Mail::to($email)->send(new PatientReportMailer($subject,$fileName,$message));
//            if($response){
//                Storage::disk('public')->delete('patients/'.$fileName);
//            }
        }
        return $this->response()->success('Patient Test Report Attached Successfully')->refresh();
    }

    public function form()
    {
      // $this->multipleFile('documents')->pathColumn('url')->rules('required|mimes:pdf');

       //$this->file('anc', 'Please select file')->rules('required|mimes:pdf');
    }

    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-default attach-patient-test-report">Upload Patient Test Report</a>
HTML;
    }

    private function uploadFile($request){
        if($request){
            $fileName = time().'.'.$request->file->extension();
            Storage::disk('public')->putFileAs('patients', $request->file('file'), $fileName);
            return $fileName;
        }
        return null;
    }

}
