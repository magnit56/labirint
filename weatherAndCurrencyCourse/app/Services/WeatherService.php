<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Measurements\Measurement;
use Measurements\Units\UnitTemperature;

class WeatherService implements WeatherServiceContract
{
    protected $key;
    protected $url;
    protected $lang;
    protected $weather;

    public function __construct(string $key, string $url, string $lang)
    {
        $this->key = $key;
        $this->url = $url;
        $this->lang = $lang;
    }

    public function getWeatherInCity(string $city): WeatherService
    {
        $response = Http::get($this->url, [
                'q' => $city,
                'appid' => $this->key,
                'lang' => 'ru',
            ]);
        if ($response->ok()) {
            $this->weather = json_decode($response->body());
        } else {
            throw new \Exception();
        }
        return $this;
    }

    public function format(): array
    {
        $name = $this->weather->name;
        // К большому сожалению api не предоставляет дату прогноза погоды
        $date = now()->format('d.m');
        $temperature = round((new Measurement($this->weather->main->temp, UnitTemperature::kelvin()))->convertTo(UnitTemperature::celsius())->value());
        $feels = round((new Measurement($this->weather->main->feels_like, UnitTemperature::kelvin()))->convertTo(UnitTemperature::celsius())->value());
        $description = $this->weather->weather[0]->description;
        return [
            'name' => $name,
            'date' => $date,
            'temperature' => $temperature,
            'feels' => $feels,
            'description' => $description,
        ];
    }
}
