<?php

namespace App\Providers;

use App\Bitcoin\LNbits\LNBitsApiAdapter;
use App\Bitcoin\WalletAPIInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(WalletAPIInterface::class, function ($app) {
            return new LNBitsApiAdapter;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
