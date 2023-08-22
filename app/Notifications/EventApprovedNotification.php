<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventApprovedNotification extends Notification
{
    use Queueable;
    protected $event;

    /**
     * Create a new notification instance.
     */
    public function __construct($event)
    {
        $this->event = $event;
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
    
    public function toDatabase(object $notifiable)
    {
        return [
            'event_id' => $this->event->id,
            'message' => 'Approval to Create Event',
            'details' => 'Your event "'.$this->event->event_name.'" has been '.$this->event->event_approval_status.'.'
        ];
    }
}
