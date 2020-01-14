<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Post;

class NotifyUser extends Notification
{
    use Queueable;

    public $post;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Post $post, $user)
    {
        $this->post = $post;
        $this->user = $user;
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

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return
     */
    public function toDatabase($notifiable)
    {
        return [
            'loca' => "/ondernemer/forum/{$this->post->id}",
            'user' => $this->user,
            'msg' => ' heeft een reactie geplaatst op jouw bericht'
        ];

    }

    public function toBroadcast($notifiable)
    {
        return [
            'data' => [
                'message' => $this->post
            ]
        ];
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
