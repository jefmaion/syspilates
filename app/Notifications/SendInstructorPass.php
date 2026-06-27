<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendInstructorPass extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        protected string $password,
        protected string $name,
        protected string $email,
        protected string $subdomain
    )
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Olá, '.$this->name)
            ->line('Reenviando sua senha de acesso')
            ->line('Usuário: '.$this->email)
            ->line('SUB: '.$this->subdomain)
            ->line('Senha temporária: '.$this->password)
            ->action('Acessar Sistemas', 'https://'.$this->subdomain.'.'.env('APP_DOMAIN').'/login')
            ->line('No primeiro acesso você deverá alterar sua senha.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
