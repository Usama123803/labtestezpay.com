<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PatientReportMailer extends Mailable
{
    use Queueable, SerializesModels;

    protected $subject;
    protected $fileName = '';
    protected $message = '';


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $fileName, $message)
    {
        $this->subject = $subject;
        $this->fileName = $fileName;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS', 'info@labwork360.com'), env('MAIL_FROM_NAME'))
            ->subject($this->subject)
            ->text($this->message)
            ->attach(public_path('storage/patients/'.$this->fileName));
    }
}
