<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\PatientMailer;
use App\Patient;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Dashboard')
            ->description('Description...');
    }

    public function patientEmail(Content $content, $id)
    {
        $patient = Patient::find($id);
        Mail::to($patient->email_address)->send(new PatientMailer($patient));
        $content->withSuccess('Email send successfully to '.$patient->first_name .' '.$patient->last_name, 'Email sent');
        return back();
    }

}
