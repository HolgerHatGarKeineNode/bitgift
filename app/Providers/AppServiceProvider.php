<?php

namespace App\Providers;

use App\Bitcoin\LNbits\LNBitsApiAdapter;
use App\Bitcoin\WalletAPIInterface;
use App\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Date::use(
            Carbon::class
        );

        $this->app->singleton(WalletAPIInterface::class, function ($app) {
            return new LNBitsApiAdapter;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Http::macro('lnbits', function () {
            return Http::withHeaders([
                'X-Api-Key' => config('bitcoin.lnbits.admin_api_key'),
            ])
                       ->baseUrl(config('bitcoin.lnbits.url'));
        });
    }
}
