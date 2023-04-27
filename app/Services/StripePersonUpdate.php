<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StripePersonUpdate
{
    public function handle(Request $request)
    {
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        $person = $stripe->accounts->updatePerson(
            Auth::user()->company->stripe_account_id,
            $request->person_id,
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => [
                    'city' => $request->city,
                    'country' => 'US',
                    'line1' => $request->line1,
                    'line2' => $request->line2 ?? '',
                    'postal_code' => $request->postal_code,
                    'state' => $request->state,
                ],
                'dob' => [
                    'day' => $request->dob['day'],
                    'month' => $request->dob['month'],
                    'year' => $request->dob['year'],
                ],
                'email' => $request->email,
                'id_number' => $request->id_number, //social
                'phone' =>  $request->phone,
                'relationship' => [
                    'director' => $request->relationship == 'Director' ? true : false,
                    'owner' => $request->relationship == 'Owner' ? true : false,
                    'executive' => $request->relationship == 'Executive' ? true : false,
                    'percent_ownership' => $request->percent_ownership ?? null,
                    'representative' => $request->relationship == 'Representative' ? true : false,
                    'title' => $request->title ?? null,
                ],
                'ssn_last_4' => "$request->ssn_last_4",
            ]
        );

        return $person;
    }
}