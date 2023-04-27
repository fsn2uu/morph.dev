<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StripePersonList
{
    public function handle()
    {
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        $persons = $stripe->accounts->allPersons(
            Auth::user()->company->stripe_account_id,
            []
        );

        return $persons;
    }
}