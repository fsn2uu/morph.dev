<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StripePersonRetrieve
{
    public function handle($person)
    {
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        $persons = $stripe->accounts->retrievePerson(
            Auth::user()->company->stripe_account_id,
            $person,
            []
        );

        return $persons;
    }
}