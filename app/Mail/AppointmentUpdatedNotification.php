<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentUpdatedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;
    public $clientName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Appointment $appointment, $clientName)
    {
        $this->appointment = $appointment;
        $this->clientName = $clientName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Appointment Updated')->view('email.appointment.updated');
    }
}
