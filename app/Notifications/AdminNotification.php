<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminNotification extends Notification
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
            ->subject('New Appointment Created')
            ->line('A new appointment has been created:')
            ->line('Date: ' . $this->appointment->date)
            ->line('Time: ' . $this->appointment->time)
            ->line('Client: ' . $this->appointment->user->name)
            ->action('View Appointment', url('/admin/appointments/' . $this->appointment->id));
    }
}

