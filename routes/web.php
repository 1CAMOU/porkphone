<?php

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
});

require __DIR__.'/auth.php';
