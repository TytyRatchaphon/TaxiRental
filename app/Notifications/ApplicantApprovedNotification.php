<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicantApprovedNotification extends Notification
{
    use Queueable;
    protected $event, $student;

    /**
     * Create a new notification instance.
     */
    public function __construct($event, $student)
    {
        $this->event = $event;
        $this->student = $student;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }
    
    public function toDatabase(object $notifiable): array
    {
        return [
            'event_id' => $this->event->id,
            'message' => 'Approval to the student in Event',
            'details' => $this->student->user->username.' is '.$this->event->students()->find($this->student->id)->pivot->status.' in '.$this->event->event_name,
        ];
    }
}
