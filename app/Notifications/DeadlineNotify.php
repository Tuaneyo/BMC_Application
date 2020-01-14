<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DeadlineNotify extends Notification
{
    use Queueable;
    public $user;
    public $component;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $component)
    {
        $this->user = $user;
        $this->component = $component;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $deadline = $this->component->deadline;
        if(!empty($deadline)){
            return [
                'user' => $this->user,
                'loca' => "/ondernemer/onderdeel/{$this->component->id}",
                'msg' => "heeft de deadline van het onderdeel {$this->component->name} gewijzigd naar " . date('d-m-Y ', strtotime($deadline))
            ];
        }else{
            return false;
        }

    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
