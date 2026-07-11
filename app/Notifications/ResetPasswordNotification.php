<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as BaseResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends BaseResetPassword
{
    /**
     * Build the mail representation of the notification.
     */
    public function toMail(mixed $notifiable): MailMessage
    {
        $url = $this->resetUrl($notifiable);

        return (new MailMessage)
            ->subject('Reset Password - Buku Tamu Kabupaten Malang')
            ->greeting('Halo!')
            ->line('Anda menerima email ini karena kami menerima permintaan reset password untuk akun admin Anda.')
            ->action('Reset Password', $url)
            ->line('Link reset password ini akan kedaluwarsa dalam '.config('auth.passwords.users.expire').' menit.')
            ->line('Jika Anda tidak merasa meminta reset password, abaikan email ini.')
            ->salutation('Salam, Tim Buku Tamu Kabupaten Malang');
    }
}
