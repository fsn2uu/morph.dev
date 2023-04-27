<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;

class StripeBanksList
{
    public function handle()
    {
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        $banks = $stripe->customers->allSources(
            Auth::user()->company->stripe_id,
            ['object' => 'bank_account']
        );

        return $banks;
    }
}