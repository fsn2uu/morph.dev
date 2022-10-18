<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Company;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreated;
use App\Mail\CompanyCreated;
use Illuminate\Support\Str;

class SignupController extends Controller
{
    public function create()
    {}

    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'routing_number' => 'required',
            'acount_number' => 'required',
            'tax_id' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'city' => 'required',
            'address' => 'required',
            'zip' => 'required',
            'state' => 'required',
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'company_phone' => 'required',
            'id_number' => 'required', //last 4 ssn
            'tos_acceptance' => 'required',
            'plan' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            'website' => 'required|active_url',
            'logo' => 'required|image|mimes:jpg,png',
            'number' => 'required',
            'exp_month' => 'required',
            'exp_year' => 'required',
            'cvc' => 'required',
            'account_holder' => 'required',
        ]);

        if($valid->fails())
        {
            return back()->withErrors($valid->errors())->withInput();
        }

        $company = Company::create([
            'name' => $request->name,
            'address' => $request->address,
            'address2' => $request->address2,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'api_token' => time() . Str::random(54),
            'accepted_terms' => 1,
            'acknowledges_legality' => 1,
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
        
        Mail::to($user)->send(new CompanyCreated($company));
        Mail::to($user)->send(new UserCreated($user));

        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

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
                'number' => $request->card,
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

        // if($company->subscribed('Morph VRM'))
        // {
        //     $company->update(['status' => 'active']);
        // }

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

        // the account id needs to go in the company record
        $company->update([
            'stripe_account_id' => $account['id'],
        ]);

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

        $stripe->customers->createSource(
            $customer['id'],
            ['source' => $token['id']]
        );

        $person = $stripe->accounts->createPerson(
            $account->id,
            [
                'first_name' => $user->fname,
                'last_name' => $user->lname,
                'email' => $user->email,
                'dob' => [
                    'day' => $request->dob_day ?: 01,
                    'month' => $request->dob_month ?: 01,
                    'year' => $request->dob_year ?: 1999,
                ],
                'phone' => $user->phone,
                'ssn_last_4' => $request->id_number,
            ]
        );

        Auth::login($user);

        return redirect()->route('admin.dashboard');
    }
}
