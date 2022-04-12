<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/weather', [App\Http\Controllers\WeatherAndCurrenciesController::class, 'weather'])->name('weatherAndCurrencies.weather');
Route::get('/currencies', [App\Http\Controllers\WeatherAndCurrenciesController::class, 'currencies'])->name('weatherAndCurrencies.currencies');
