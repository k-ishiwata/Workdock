<?php

namespace App\Providers;

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
        // 開発者のみ許可
        \Gate::define('admin', function ($user) {
            return ($user->role_id == 0);
        });
        // 一般ユーザ
        \Gate::define('user', function ($user) {
            return ($user->role_id >= 1 && $user->role_id <= 5);
        });
    }
}
