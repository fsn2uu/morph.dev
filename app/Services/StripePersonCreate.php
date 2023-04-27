<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StripePersonCreate
{
    public function handle(Request $request)
    {
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        $person = $stripe->accounts->createPerson(
            Auth::user()->company->stripe_account_id,
            [
                'first_name' => $request->first,
                'last_name' => $request->last,
                'address' => [
                    'city' => $request->city,
                    'country' => 'US',
                    'line1' => $request->adress,
                    'line1' => $request->address2 ?? '',
                    'postal_code' => $request->zip,
                    'state' => $request->state,
                ],
                'dob' => [
                    'day' => $request->dob_day,
                    'month' => $request->dob_month,
                    'year' => $request->dob_year,
                ],
                'email' => $request->email,
                'id_number' => $request->id_number, //social
                'phone' =>  $request->phone,
                'relationship' => [
                    'director' => $request->relationship == 'director' ? true : false,
                    'owner' => $request->relationship == 'owner' ? true : false,
                    'executive' => $request->relationship == 'executive' ? true : false,
                    'percent_ownership' => $request->percent_ownership,
                    'representative' => $request->relationship == 'representative' ? true : false,
                    'title' => $request->title,
                ],
                'ssn_last_4' => $request->ssn_last_4,
            ]
        );

        User::find($request->user_id)->update(['stripe_id', $person->id]);

        return $person;
    }
}