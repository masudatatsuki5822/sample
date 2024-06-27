<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        //ログイン後のゲート
        //管理ユーザー
        Gate::define('admin',function (User $user) {
            return ($user->role === 0);
        });
        //保育園ユーザー
        Gate::define('nursery',function (User $user) {
            return ($user->role === 1);
        });
        //生徒ユーザー
        Gate::define('student',function (User $user) {
            return ($user->role === 2);
        });
    }
}
