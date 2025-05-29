<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Observers\CategoryObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        require_once app_path('Helpers/helpers.php');
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
}