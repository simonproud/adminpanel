<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserCreated extends Notification implements ShouldQueue
{
    use Queueable;

    protected $newuser;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $newuser)
    {
        $this->newuser = $newuser;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [

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
            'id' => $this->id,
            'read_at' => null,
            'data' => [
                'user' => $this->newuser,
                'message' => "Был зарегистрирован новый пользователь: \<br/\> ".$this->newuser->email." !"
            ],
        ];
    }
}
