<?php

namespace App\Http\Controllers;

use App\Services\CurrencyServiceContract;
use App\Services\WeatherServiceContract;
use Illuminate\Http\Request;

class WeatherAndCurrenciesController extends Controller
{
    protected $weatherService;
    protected $currencyService;

    public function __construct(WeatherServiceContract $weatherService, CurrencyServiceContract $currencyService)
    {
        $this->weatherService = $weatherService;
        $this->currencyService = $currencyService;
    }

    public function index()
    {
        $weather = $this->weatherService->getWeatherInCity('Moscow')->format();
        $currencies = $this->currencyService->getCurrencyCourses(['USD', 'EUR', 'SEK', 'JPY', 'CAD']);
        return view('news.show', compact('weather', 'currencies'));
    }

    public function weather() {
        $weather = $this->weatherService->getWeatherInCity('Moscow')->format();
        return json_encode($weather);
    }

    public function currencies() {
        $currencies = $this->currencyService->getCurrencyCourses(['USD', 'EUR', 'SEK', 'JPY', 'CAD']);
        return json_encode($currencies);
    }
}
