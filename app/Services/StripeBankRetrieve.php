<?php
namespace App\Services;

class StripeBankRetrieve
{
    public function handle($stripe_id, $bank_id)
    {
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        $bank = $stripe->customers->retrieveSource(
            $stripe_id,
            $bank_id,
            []
        );

        return $bank;
    }
}