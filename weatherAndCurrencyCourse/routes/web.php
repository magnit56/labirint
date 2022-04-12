<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\WeatherAndCurrenciesController::class, 'index'])->name('weatherAndCurrencies.index');
//Route::get('/', function () {
//    return view('news.show');
//});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
