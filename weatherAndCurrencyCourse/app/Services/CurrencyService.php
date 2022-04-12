<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use XMLParser\XMLParser;

class CurrencyService implements CurrencyServiceContract
{
    protected $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function getCurrencyCourses($targetCurrencies = ['EUR', 'USD'])
    {
        $response = Http::get($this->url);
        if ($response->ok()) {
            $allCurrencies = XMLParser::decode($response->body())->Valute;
            $currencies = collect($allCurrencies)->filter(function ($currency) use ($targetCurrencies) {
                return in_array($currency->CharCode, $targetCurrencies);
            })->values();
        } else {
            throw new \Exception();
        }
        return $currencies;
    }

}
