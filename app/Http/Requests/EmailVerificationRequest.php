<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class EmailVerificationRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $verificationToken;

    public function __construct($user, $verificationToken)
    {
        $this->user = $user;
        $this->verificationToken = $verificationToken;
    }

    public function build()
    {
        return $this->view('emails.verify-email')
        ->subject('Verify Your Email');
    }
}