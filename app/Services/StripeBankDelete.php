<?php
namespace App\Services;

class StripeBankDelete
{
    public function handle($stripe_id, $bank_id)
    {
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        $bank = $stripe->customers->deleteSource(
            $stripe_id,
            $bank_id,
            []
        );

        return $bank;
    }
}