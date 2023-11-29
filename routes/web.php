<?php

use App\Http\Controllers\Payments\CoinbaseController;
use App\Http\Controllers\Payments\PaymentController;
use App\Http\Controllers\Payments\StripeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Home');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/checkout', [PaymentController::class, 'index'])->name('checkout.index');
    Route::get('/checkout/stripe/success', [StripeController::class, 'success'])->name('checkout.stripe.success');
    Route::post('/checkout/stripe', [StripeController::class, 'checkout'])->name('checkout.stripe');
    Route::get('/checkout/coinbase/success', [CoinbaseController::class, 'success'])->name('checkout.coinbase.success');
    Route::post('/checkout/coinbase', [CoinbaseController::class, 'checkout'])->name('checkout.coinbase');
});

require __DIR__.'/auth.php';
