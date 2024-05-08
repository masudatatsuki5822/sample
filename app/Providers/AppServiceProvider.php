<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Nursery;
use App\Models\User;

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
        // 保育園名を全てのviewに渡す
        view()->composer('*', function ($view) {
            $nursery = new Nursery();
            $view->with('nursery', $nursery->nurseryName());
        });

        // 生徒名を全てのviewに渡す
        view()->composer('*', function ($view) {
            $studentName = new User();
            $view->with('studentName', $studentName->getStudentName());
        });
    }
}
