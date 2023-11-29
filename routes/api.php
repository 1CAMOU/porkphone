<?php

use App\Http\Controllers\Payments\CoinbaseController;
use App\Http\Controllers\Payments\StripeController;
use Illuminate\Support\Facades\Route;

Route::post('/webhook/stripe', [StripeController::class, 'webhook']);
Route::post('/webhook/coinbase', [CoinbaseController::class, 'webhook']);
