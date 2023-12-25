<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OtpEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $message;
    public $userEmail;
    public $otp;
    public function __construct($userEmail,$message , $otp)
    {
        $this->message = $message;
        $this->userEmail = $userEmail;
        $this->otp = $otp;
    }



    public function build()
{
    return $this->view('otp')
                ->with('message',$this->message)
                ->with('otp',$this->otp)
                ->subject($this->message)
                ->to($this->userEmail);
}

}
