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
        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->view('emails.patient')
            ->with(
                [
                   'patient'=> $this->patient
                ])
            ->attach(storage_path($this->patient->additional_doc));
//            ->attach(public_path('/images').'/demo.jpg', [
//                'as' => 'demo.jpg',
//                'mime' => 'image/jpeg',
//            ]);
//        return $this->view('view.name');
    }
}
