<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $token; // Add $token property

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, $token)
    {
        $this->user = $user;
        $this->token = $token; // Assign the token to the property
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->view('email.verify-email')
            ->subject('Email Verification')
            ->with(['verificationToken' => $this->token]); // Pass the token with the correct name
    }

}