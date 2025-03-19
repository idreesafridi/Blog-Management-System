<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class LikeOrCommentNotification extends Notification
{
    public $user; // The user who liked or commented

    public function __construct($user)
    {
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
        return ['database', 'mail']; // Can also use 'broadcast' or other channels
    }

    /**
     * Get the database notification representation.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'message' => "{$this->user->name} liked/commented on your post", // Customize this
            'user_id' => $this->user->id,
        ];
    }

    /**
     * Get the mail notification representation.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('New Interaction')
                    ->line("{$this->user->name} liked/commented on your post.")
                    ->action('View Post', url('/posts/'.$this->user->post_id)); // Customize URL as needed
    }
}

