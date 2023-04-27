<?php
namespace App\Services;

use Stripe\StripeClient;
use Illuminate\Support\Facades\Auth;

class StripeBanks
{
    protected $stripe;

    public function __construct(StripeClient $stripe)
    {
        $stripeSecret = env('STRIPE_SECRET');
        $this->stripe = new StripeClient($stripeSecret);
    }

    public function list()
    {
        $banks = $this->stripe->customers->allSources(
            Auth::user()->company->stripe_id,
            ['object' => 'bank_account']
        );

        return $banks;
    }

    public function token($request)
    {
        $token = $stripe->tokens->create([
            'bank_account' => [
              'country' => 'US',
              'currency' => 'usd',
              'account_holder_name' => $request->account_holder,
              'account_holder_type' => 'individual',
              'routing_number' => $request->routing_number,
              'account_number' => $request->account_number,
              'bank_name' => $request->bank_name
            ],
        ]);

        return $token;
    }

    public function create(Request $request)
    {
        $token = $this->token($request);

        $bank = $this->stripe->customers->createSource(
            Auth::user()->company->stripe_id,
            ['source' => $token->id]
        );

        $this->stripe->customers->verifySource(
            Auth::user()->company->stripe_id,
            $bank->id,
            ['amounts' => [32, 45]]
        );

        return $bank;
    }

    public function update($bank_id, Request $request)
    {
        $bank = $this->stripe->customers->updateSource(
            Auth::user()->company->stripe_id,
            $bank_id,
            [
                "account_holder_name" => $request->account_holder_name,
                "account_holder_type" => $request->account_holder_type,
                "bank_name" => $request->bank_name,
            ]
        );

        return $bank;
    }

    public function delete($bank_id)
    {
        $bank = $this->stripe->customers->deleteSource(
            Auth::user()->company->stripe_id,
            $bank_id,
            []
        );

        return $bank;
    }

    public function retrieve($bank_id)
    {
        $bank = $this->stripe->customers->retrieveSource(
            Auth::user()->company->stripe_id,
            $bank_id,
            []
        );

        return $bank;
    }
}