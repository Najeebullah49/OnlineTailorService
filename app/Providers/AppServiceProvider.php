<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Register the view composer to share user data with all views
        View::composer('*', function ($view) {
            // Get the user from the session (if available)
            $user = session()->get('id') ? User::find(session()->get('id')) : null;
            // Share the user with all views
            $view->with('user', $user);
        });

        // Admin-specific data sharing
    View::composer('*', function ($view) {
        $admindata = session()->get('id') ? User::find(session()->get('id')) : null;
        $view->with('admindata', $admindata);
    });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
