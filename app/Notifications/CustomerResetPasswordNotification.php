<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class CustomerResetPasswordNotification extends ResetPasswordNotification
{
    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // Generate a custom reset link for customers
        $resetUrl = url(route('customer.password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false)); // Relative URL

        // Construct the email message
        return (new MailMessage)
            ->subject(Lang::get('Reset Your Password'))
            ->greeting(Lang::get('Hello, :name', ['name' => $notifiable->name]))
            ->line(Lang::get('You are receiving this email because we received a password reset request for your account.'))
            ->action(Lang::get('Reset Password'), $resetUrl)
            ->line(Lang::get('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line(Lang::get('If you did not request a password reset, no further action is required.'));
    }
}
