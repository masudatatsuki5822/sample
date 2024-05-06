<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Nursery;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        view()->composer('*', function ($view) {
            $nursery = new Nursery();
            $view->with('nursery', $nursery->nurseryName());
        });
    }
}
