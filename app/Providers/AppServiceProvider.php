<?php

namespace App\Providers;

use App\Models\Withdraw;
use App\Observers\WithdrawObserver;
use Illuminate\Support\ServiceProvider;

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
        Withdraw::observe(WithdrawObserver::class);
    }
}
