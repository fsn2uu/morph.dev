<?php

namespace App\Http\Controllers\Settings\Gateway;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\StripePersons;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(StripePersons $stripePersons)
    {
        $persons = $stripePersons->list();

        return view('admin.settings.gateway.persons.index')
            ->withPersons($persons);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.settings.gateway.persons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, StripePersons $stripePersons)
    {
        $person = $stripePersons->create($request);

        return redirect()->route('admin.settings.gateway.persons.show', $request->user_id);
    }

    /**
     * Display the specified resource.
     */
    public function show($person_id, StripePersons $stripePersons)
    {
        $person = $stripePersons->retrieve($person_id);
        $user = User::where('stripe_id', $person_id)->first();

        return view('admin.settings.gateway.persons.show')
            ->withPerson($person)
            ->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($person_id, StripePersons $stripePersons)
    {
        $person = $stripePersons->retrieve($person_id);
        $user = User::where('stripe_id', $person_id)->first();

        return view('admin.settings.gateway.persons.edit')
            ->withPerson($person)
            ->withUser($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($person_id, Request $request, StripePersons $stripePersons)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'dob.month' => 'required',
            'dob.day' => 'required',
            'dob.year' => 'required|date_format:Y',
            'relationship' => 'required',
            'percent_owner' => $request->relationship == 'Owner' ? 'required|numeric|min:1|max:100' : ''
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $request->merge(['person_id' => $person_id]);
        
        $person = $stripePersons->update($request);

        return redirect()->route('admin.settings.gateway.persons.edit', $person->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, StripePersons $stripePersons)
    {
        //NEED TO DO SOME CHECKS:
        //CAN'T DELETE IF THERE IS ONLY ONE PERSON ON THE GATEWAY
        //CAN'T DELETE IF ALL THAT IS LEFT ARE REPRESENTATIVES
        //CAN'T DELETE THEMSELVES
        $stripePersons->delete($stripe_id);

        $user->update(['stripe_id' => null]);

        return redirect()->route('admin.gateway.persons.index');
    }
}
