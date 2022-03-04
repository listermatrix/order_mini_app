<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TransSuccess extends Notification
{
    use Queueable;

    private $trans;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($trans)
    {
        $this->trans = $trans;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
                    ->greeting("Hello {$this->trans->receiver->first_name},")
                    ->line("Your account has been credited with {$this->trans->amount_received} {$this->trans->target_currency->code}.")
                    ->line("From  {$this->trans->sender->getFullNameAttribute()}.")
                    ->action('Dashboard', url('/login'))
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
