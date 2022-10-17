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

class SignupController extends Controller
{
    public function create()
    {}

    public function store(Request $request)
    {
        //MOVE THE VALIDATOR TO A RESOURCE LATER
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
            'id_number' => 'required', //last 4 ssn
            'tos_acceptance' => 'required',
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
        ]);

        //send sub info to Stripe
        $company->newSubscription('Morph VRM', $request->plan)->create($request->stripeToken, [
            'name'    => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
        ]);

        if($company->subscribed('Morph VRM'))
        {
            $company->update(['status' => 'active']);
        }

        $account = \Stripe\Account::create([
          "type" => "custom",
          "country" => "US",
          "email" => $request->email,
          "business_type" => 'company',
          "requested_capabilities" => ["card_payments", "transfers"],
          "external_account" => [
              "object"    => 'bank_account',
              "country"    => 'US',
              "currency"    => 'usd',
              "account_holder_name"    => $request->first_name.' '.$request->last_name,
              "account_holder_type"    => 'company',
              "routing_number"    => $request->routing_number,
              "account_number"    => $request->account_number,
          ],
          "business_profile"    => [
              "mcc"    => 6513,
              "name"    => $request->name,
              "url"    => $request->website,
          ],
          "tos_acceptance" => [
              "date"    => time(),
              "ip"    => $request->ip(),
          ],
          "company" => [
              "name"    => $request->name,
              "phone"    => $request->phone,
              "tax_id"    => $request->tax_id,
              "address"    => [
                  "city"    => $request->city,
                  "line1"    => $request->address,
                  "postal_code"    => $request->zip,
                  "state"    => $request->state,
              ],
          ],
        ]);

        $account = $account->__toArray();

        // the account id needs to go in the company record
        $company->update([
            'stripe_account_id' => $account['id'],
        ]);

        $user = User::create([
            'company_id' => $company->id,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'phone2' => $request->phone2,
            'password' => Hash::make($request->password),
        ]);

        $person = \Stripe\Account::createPerson(
          $account['id'],
          [
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'address'    => [
                'city' => $request->city,
                'country' => 'US',
                'line1' => $request->address,
                'postal_code' => $request->zip,
                'state' => $request->state,
            ],
            'dob' => [
                'day' => $request->day,
                'month' => $request->month,
                'year' => $request->year,
            ],
            'email' => $request->email,
            'id_number' => $request->id_number, //last 4 ssn
            'phone' => $request->phone,
            'relationship' => [
                'account_opener' => true,
                'title' => 'CEO',
                'owner' => true,
                'percent_ownership' => 100,
            ],
          ]
        );
    }
}
