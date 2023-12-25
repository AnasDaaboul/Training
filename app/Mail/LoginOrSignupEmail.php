<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Response;

class LoginOrSignupEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $message;
    public $userEmail;
    public function __construct($userEmail,$message)
    {
        $this->message = $message;
        $this->userEmail = $userEmail;
    }

    public function build()
    {
        return $this->view('email' , [$this->message , $this->userEmail])
                    ->subject($this->message)
                    ->to($this->userEmail);
    }
}
