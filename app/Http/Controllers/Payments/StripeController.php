<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Inertia\Inertia;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Stripe;
use Stripe\Webhook;
use UnexpectedValueException;

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
                        'name' => 'Top up PorkPhone Balance',
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
        ray($request->all())->blue();
        return inertia('Payments/Success');
    }

    public function webhook(Request $request) {
        Stripe::setApiKey(Env::get('STRIPE_SECRET_KEY'));

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];

        try {
            $event = Webhook::constructEvent(
                $payload, $sig_header, Env::get('STRIPE_WEBHOOK_SECRET')
            );
        } catch(UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            echo json_encode(['Error parsing payload: ' => $e->getMessage()]);
            exit();
        } catch(SignatureVerificationException $e) {
            // Invalid signature
            http_response_code(400);
            echo json_encode(['Error verifying webhook signature: ' => $e->getMessage()]);
            exit();
        }

        // Handle the event
        switch ($event->type) {
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object;
                if (!$paymentIntent) logger()->error('[Stripe Webhook] Payment intent not found!');

                $stripe_customer_id = $paymentIntent->customer;
                $user = User::where('stripe_customer_id', $stripe_customer_id)->first();
                if (!$user) logger()->error('[Stripe Webhook] User not found!');
                $amount = $paymentIntent->amount / 100;
                $user->balance = $user->balance + $amount;
                $user->save();
                break;
            default:
                echo 'Received unknown event type ' . $event->type;
        }
    }
}
