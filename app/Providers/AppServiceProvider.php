<?php

namespace App\Providers;

use App\Booking;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $booking_count = 0;

            $booking_count = Booking::where('status', 1)->count();

            $view->with('booking_count', $booking_count);
        });
    }
}
