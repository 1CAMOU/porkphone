<?php

namespace App\Http\Controllers\Payments;

use Antimech\Coinbase\Facades\Coinbase;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Inertia\Inertia;

class CoinbaseController extends Controller
{
    public function checkout(Request $request) {
        $validatedData = $request->validate([
            'amount' => ['required', 'numeric', 'min:1', 'max:1000000']
        ]);

        $charge = Coinbase::createCharge([
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'requested_info' => [],
            'redirect_url' => route('checkout.coinbase.success'),
            'metadata' => ['stripe_customer_id' => auth()->user()->stripe_customer_id],
            'description' => 'Balance Top Up',
            'local_price' => [
                'amount' => $validatedData['amount'],
                'currency' => 'USD',
            ],
            'pricing_type' => 'fixed_price',
        ]);

        return Inertia::location($charge['data']['hosted_url']);
    }

    public function success() {
        return inertia('Payments/Success');
    }

    public function webhook(Request $request) {
        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['X-CC-Webhook-Signature'];
        $secret = Env::get('COINBASE_WEBHOOK_SECRET');

        if (empty($payload) || empty($sig_header) || empty($secret)) {
            // Invalid payload
            http_response_code(400);
            echo json_encode(['Error parsing payload']);
            exit();
        }

        $expectedSig = hash_hmac('sha256', $payload, $secret);

        if (!hash_equals($expectedSig, $sig_header)) {
            // Invalid signature
            http_response_code(400);
            echo json_encode(['Error verifying webhook signature']);
            exit();
        }

        // Handle the event
        $event = $request->input('event');
        switch ($event['type']) {
            case 'charge:confirmed':
                $charge = $request->input('event')['data'];
                if (!$charge) logger()->error('[Coinbase Webhook] Charge not found!');

                $stripe_customer_id = $charge['metadata']['stripe_customer_id'];
                $user = User::where('stripe_customer_id', $stripe_customer_id)->first();
                if (!$user) logger()->error('[Coinbase Webhook] User not found!');
                $amount = $charge['pricing']['local']['amount'];
                $user->balance = $user->balance + $amount;
                $user->save();
                break;
            default:
                echo 'Received unknown event type ' . $event['type'];
        }
    }
}
