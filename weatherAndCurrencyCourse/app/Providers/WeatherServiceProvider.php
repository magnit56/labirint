<?php

namespace App\Providers;

use App\Services\WeatherService;
use App\Services\WeatherServiceContract;
use Illuminate\Support\ServiceProvider;

class WeatherServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(WeatherServiceContract::class, function ($app) {
            $key = config('weather.key', 'non-existing-key');
            $url = config('weather.url', 'https://example.com');
            $lang = config('app.locale', 'ru');
            return new WeatherService($key, $url, $lang);
        });
    }
}
