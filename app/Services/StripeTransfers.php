<?php
namespace App\Services;

use Stripe\StripeClient;
use Illuminate\Support\Facades\Auth;

class StripeTransfers
{
    protected $stripe;

    public function __construct(StripeClient $stripe)
    {
        $stripeSecret = env('STRIPE_SECRET');
        $this->stripe = new StripeClient($stripeSecret);
    }

    public function list()
    {
        $transfers = $this->stripe->transfers->all(['destination' => Auth::user()->company->stripe_account_id]);

        return $transfers;
    }

    public function create($amount)
    {
        $transfer = $this->stripe->transfers->create([
            'amount' => $amount,
            'currency' => 'usd',
            'destination' => Auth::user()->company->stripe_account_id,
        ]);

        return $transfer;
    }

    public function retrieve($transfer_id)
    {
        $transfer = $this->stripe->transfers->retrieve(
            $transfer_id,
            []
        );

        return $transfer;
    }
}