<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Route;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Customize the email verification URL
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            // Use the named route for customer login and pass the verification URL as a query parameter
            $customUrl = route('Customer.login', ['email_verification_url' => urlencode($url)]);

            return (new MailMessage)
                ->subject('Verify Your Email Address')
                ->line('Click the button below to verify your email address.')
                ->action('Verify Email Address', $customUrl) // Use the custom URL
                ->line('If you did not create an account, no further action is required.');
        });
    }
}
