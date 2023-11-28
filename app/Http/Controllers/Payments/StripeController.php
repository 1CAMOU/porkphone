<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Inertia\Inertia;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;

class StripeController extends Controller
{
    /**
     * @throws ApiErrorException
     */
    public function checkout(Request $request) {
        Stripe::setApiKey(Env::get('STRIPE_SECRET_KEY'));

        $validatedData = $request->validate([
            'amount' => ['required', 'numeric', 'min:1', 'max:1000000']
        ]);

        $checkout_session = Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Fill up $' . $validatedData['amount'],
                    ],
                    'unit_amount' => $validatedData['amount'] * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('checkout.stripe.success'),
            'cancel_url' => route('checkout.index'),
            'customer' => auth()->user()->stripe_customer_id,
        ]);

        return Inertia::location($checkout_session->url);
    }

    public function success(Request $request) {
        ray($request->all());
        return inertia('Payments/Success');
    }
}
