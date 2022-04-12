<?php

namespace App\Providers;

use App\Services\CurrencyService;
use App\Services\CurrencyServiceContract;
use Illuminate\Support\ServiceProvider;

class CurrencyServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(CurrencyServiceContract::class, function ($app) {
            $url = config('currency.url', 'https://example.com');
            return new CurrencyService($url);
        });
    }
}
