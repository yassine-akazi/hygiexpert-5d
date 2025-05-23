<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ContactMessage;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

   
    public function boot(): void
    {
        // Partager $client avec toutes les vues Blade
        View::composer('*', function ($view) {
            $view->with('client', Auth::guard('client')->user());
        });
    }
}