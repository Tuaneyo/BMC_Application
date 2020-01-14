<?php

namespace App\Notifications;

use App\Models\Component;
use App\Models\UserAssigment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RatedUser extends Notification
{
    use Queueable;
    public $assignment;
    public $component;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(UserAssigment $assignment, $user, $component)
    {
        $this->assignment = $assignment;
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
        switch ($this->assignment->rated){
            case 1:
                $rated = 'onvoldoende';
                break;
            case 2:
                $rated = 'voldoende';
                break;
        }
        return [
            'user' => $this->user,
            'loca' => "/ondernemer/onderdeel/{$this->assignment->component_id}",
            'msg' => "heeft een beoordeling geplaatst van jouw onderdeel {$this->component->name}."
        ];

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
