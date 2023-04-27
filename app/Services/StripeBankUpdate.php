<?php
namespace App\Services;

use Illuminate\Http\Request;

class StripeBankUpdate
{
    public function handle($stripe_id, $bank_id, Request $request)
    {
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );
        
        $bank = $stripe->customers->updateSource(
            $stripe_id,
            $bank_id,
            [
                "account_holder_name" => $request->account_holder_name,
                "account_holder_type" => $request->account_holder_type,
                "account_type" => null,
                "bank_name" => $request->bank_name,
                "country" => "US",
                "currency" => "usd",
                "customer" => $stripe_id,
                "last4" => $request->last4,
            ]
        );

        return $bank;
    }
}