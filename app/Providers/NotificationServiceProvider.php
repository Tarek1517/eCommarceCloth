<?php

namespace App\Providers;

use App\Models\ContactForm;
use App\Models\Order;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    public function boot()
    {

        View::composer('*', function ($view) {

            $newOrdersCount = Order::where('status', 'ordered')->count();

            $newMessagesCount = ContactForm::where('is_read', false)->count();

            $view->with([
                'newOrdersCount' => $newOrdersCount,
                'newMessagesCount' => $newMessagesCount,
            ]);
        });
    }

    public function register()
    {
        //
    }
}
