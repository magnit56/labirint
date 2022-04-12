<?php

namespace App\Services;

use Illuminate\Support\Collection;

interface WeatherServiceContract
{
    public function getWeatherInCity(string $city): WeatherService;

    public function format(): array;
}
