<?php
namespace App\Services;

use App\Models\User;
use Stripe\StripeClient;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;

class StripePersons
{
    protected $stripe;

    public function __construct(StripeClient $stripe)
    {
        $stripeSecret = env('STRIPE_SECRET');
        $this->stripe = new StripeClient($stripeSecret);
    }

    public function list()
    {
        $persons = $this->stripe->accounts->allPersons(
            Auth::user()->company->stripe_account_id,
            []
        );

        return $persons;
    }

    public function create(Request $request)
    {
        $person = $this->stripe->accounts->createPerson(
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

    public function delete($person_id)
    {
        $person = $this->stripe->accounts->deletePerson(
            Auth::user()->company->stripe_account_id,
            $person_id,
            []
        );

        return $person;
    }

    public function retrieve($person)
    {
        $persons = $this->stripe->accounts->retrievePerson(
            Auth::user()->company->stripe_account_id,
            $person,
            []
        );

        return $persons;
    }

    public function update(Request $request)
    {
        $person = $this->stripe->accounts->updatePerson(
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