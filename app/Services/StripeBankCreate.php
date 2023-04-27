<?php
namespace App\Services;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StripeBankCreate
{
    public function handle(Request $request)
    {
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        $token = $stripe->tokens->create([
            'bank_account' => [
              'country' => 'US',
              'currency' => 'usd',
              'account_holder_name' => $request->account_holder,
              'account_holder_type' => $request->account_holder_type,
              'routing_number' => $request->routing_number,
              'account_number' => $request->account_number,
            ],
        ]);

        $bank_account = $stripe->customers->createSource(
            Auth::user()->company->stripe_id,
            ['source' => $token['id']]
        );

        Bank::create([
            'company_id' => Auth::user()->company->id,
            'stripe_id' => $bank_account['id'],
            'split' => 100,
            'split_type' => 'percent',
        ]);

        $stripe->customers->verifySource(
            Auth::user()->company->stripe_id,
            $bank_account['id'],
            ['amounts' => [32, 45]]
        );

        return $bank_account;
    }
}