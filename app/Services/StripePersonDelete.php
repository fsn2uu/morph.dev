<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StripePersonDelete
{
    public function handle($person_id)
    {
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        $person = $stripe->accounts->deletePerson(
            Auth::user()->company->stripe_account_id,
            $person_id,
            []
        );

        return $person;
    }
}