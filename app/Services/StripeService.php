<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Http\Requests\SignupRequest;

class StripeService
{
    public function handle(SignupRequest $request)
    {
        $company = Company::create([
            'name' => $request->name,
            'address' => $request->address,
            'address2' => $request->address2,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'accepted_terms' => $request->accepted_terms,
            'acknowledges_legality' => $request->acknowledged_legality,
        ]);

        $user = User::withoutEvents(function() use($company, $request) {
            $user = new User;
            $user->company_id = $company->id;
            $user->fname = $request->fname;
            $user->lname = $request->lname;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->phone2 = $request->phone2;
            $user->password = Hash::make($request->password);
            
            $user->save();
            
            return $user;
        });
        
        $user->assignRole('manager');

        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        try
        {
            $customer = $stripe->customers->create([
                'name' => $company->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'address' => [
                    'line1' => $company->address,
                    'line2' => $company->address2,
                    'city' => $company->city,
                    'state' => $company->state,
                    'postal_code' => $company->zip,
                ],
            ]);
    
            $payment_method = $stripe->paymentMethods->create([
                'type' => 'card',
                'card' => [
                    'number' => $request->number,
                    'exp_month' => $request->exp_month,
                    'exp_year' => $request->exp_year,
                    'cvc' => $request->cvc,
                ],
            ]);
            
            $stripe->paymentMethods->attach(
                $payment_method['id'],
                ['customer' => $customer['id']]
            );
    
            $stripe->customers->update(
                $customer['id'],
                ['invoice_settings' => ['default_payment_method' => $payment_method['id']]]
            );
    
            $stripe->subscriptions->create([
                'customer' => $customer['id'],
                'trial_from_plan' => true,
                'items' => [
                    ['price' => $request->plan],
                ],
            ]);
    
            $account = $stripe->accounts->create([
                'type' => 'custom',
                'country' => 'US',
                'email' => $user->email,
                'capabilities' => [
                  'card_payments' => ['requested' => true],
                  'transfers' => ['requested' => true],
                ],
                'business_type' => 'company',
            ]);
        }
        catch(e)
        {}

        // the account id needs to go in the company record
        $company->update([
            'stripe_account_id' => $account['id'],
            'stripe_id' => $customer['id'],
        ]);
        
        try
        {
            $token = $stripe->tokens->create([
                'bank_account' => [
                  'country' => 'US',
                  'currency' => 'usd',
                  'account_holder_name' => $request->account_holder,
                  'account_holder_type' => 'individual',
                  'routing_number' => $request->routing_number,
                  'account_number' => $request->account_number,
                ],
            ]);
    
            $bank_account = $stripe->customers->createSource(
                $customer['id'],
                ['source' => $token['id']]
            );

            $stripe->customers->verifySource(
                $customer['id'],
                $bank_account['id'],
                ['amounts' => [32, 45]]
            );

            $person = $stripe->accounts->createPerson(
                $account->id,
                [
                    'first_name' => $user->fname,
                    'last_name' => $user->lname,
                    'email' => $user->email,
                    'dob' => [
                        'day' => $request->dob_day,
                        'month' => $request->dob_month,
                        'year' => $request->dob_year,
                    ],
                    'phone' => $user->phone,
                    'ssn_last_4' => $request->id_number,
                ]
            );
        }
        catch(e)
        {}

        return $user;
    }
}