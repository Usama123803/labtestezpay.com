<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PatientMailer extends Mailable
{
    use Queueable, SerializesModels;

    protected $patient;
    protected $patientAppointment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($patient, $patientAppointment)
    {
        $this->patient = $patient;
        $this->patientAppointment = $patientAppointment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS', 'info@labwork360.com'), env('MAIL_FROM_NAME'))
            ->subject('COVID 19 RT PCR TEST RESULTS')
            ->view('emails.patient')
            ->with(
                [
                   'patient'=> $this->patient
                ])
//            ->attach(asset('storage/'.$this->patient->additional_doc));
            ->attach(public_path('storage/'.$this->patientAppointment->additional_doc));
//            ->attach(public_path('/images').'/demo.jpg', [
//                'as' => 'demo.jpg',
//                'mime' => 'image/jpeg',
//            ]);
//        return $this->view('view.name');
    }
}
