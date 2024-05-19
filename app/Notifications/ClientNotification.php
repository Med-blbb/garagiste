<?php

namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ClientNotification extends Notification
{
    use Queueable;

    protected $appointment;

    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Appointment Confirmation')
            ->line('Your appointment has been successfully scheduled:')
            ->line('Date: ' . $this->appointment->date)
            ->line('Time: ' . $this->appointment->time)
            ->action('View Appointment', url('/client/appointments/' . $this->appointment->id));
    }
}
