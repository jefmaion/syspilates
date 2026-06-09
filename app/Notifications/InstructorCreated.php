<?php

namespace App\Notifications;

use App\Actions\SetDatabase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class InstructorCreated extends Notification implements ShouldQueue
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
            ->subject('Seu acesso foi criado')
            ->greeting('Olá, '.$this->name)
            ->line('Seu acesso ao sistema foi criado.')
            ->line('Usuário: '.$this->email)
            ->line('Senha temporária: '.$this->password)
            // ->action('Acessar Sistema', 'https://'.$this->subdomain.'.'.env('APP_DOMAIN').'/login')
            ->action('Acessar Sistema', url('/'))
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
