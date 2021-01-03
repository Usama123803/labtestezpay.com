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

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($patient)
    {
        $this->patient = $patient;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        //dd(public_path('storage/'.$this->patient->additional_doc));

        return $this->from(env('MAIL_FROM_ADDRESS', 'info@labwork360.com'), env('MAIL_FROM_NAME'))
            ->subject('Patient Documents')
            ->view('emails.patient')
            ->with(
                [
                   'patient'=> $this->patient
                ])
//            ->attach(asset('storage/'.$this->patient->additional_doc));
            ->attach(public_path('storage/'.$this->patient->additional_doc));
//            ->attach(public_path('/images').'/demo.jpg', [
//                'as' => 'demo.jpg',
//                'mime' => 'image/jpeg',
//            ]);
//        return $this->view('view.name');
    }
}
