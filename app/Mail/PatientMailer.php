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
        return $this->from('no-reply@example.com', 'No Reply')
            ->view('emails.patient')
            ->with(
                [
                   'patient'=> $this->patient
                ])
            ->attachFromStorage($this->patient->additional_doc);
//            ->attach(public_path('/images').'/demo.jpg', [
//                'as' => 'demo.jpg',
//                'mime' => 'image/jpeg',
//            ]);
//        return $this->view('view.name');
    }
}
