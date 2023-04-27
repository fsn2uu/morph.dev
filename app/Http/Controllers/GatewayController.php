<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\StripeBanksList;
use App\Services\StripePersonList;
use App\Services\StripePersonDelete;
use App\Services\StripePersonUpdate;
use App\Services\StripePersonRetrieve;
use Illuminate\Support\Facades\Validator;

class GatewayController extends Controller
{
    public function personsIndex(StripePersonList $personList)
    {
        $persons = $personList->handle();

        return view('admin.settings.gateway.persons.index')
            ->withPersons($persons);
    }

    public function personsCreate()
    {
        return view('admin.settings.gateway.persons.create');
    }

    public function personsStore(Request $request)
    {}

    public function personsShow(User $user, StripePersonRetrieve $stripePersonRetrieve)
    {
        $person = $stripePersonRetrieve->handle($user->stripe_id);

        return view('admin.settings.gateway.persons.show')
            ->withPerson($person)
            ->withUser($user);
    }

    public function personsEdit(User $user, StripePersonRetrieve $stripePersonRetrieve)
    {
        $person = $stripePersonRetrieve->handle($user->stripe_id);

        return view('admin.settings.gateway.persons.edit')
            ->withPerson($person)
            ->withUser($user);
    }

    public function personsUpdate(User $user, Request $request, StripePersonUpdate $stripePersonUpdate)
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

        $request->merge(['person_id' => $user->stripe_id]);
        
        $person = $stripePersonUpdate->handle($request);

        return redirect()->route('admin.gateway.persons.edit', $user);
    }

    public function personsDelete($stripe_id, StripePersonDelete $stripePersonDelete)
    {
        //NEED TO DO SOME CHECKS:
        //CAN'T DELETE IF THERE IS ONLY ONE PERSON ON THE GATEWAY
        //CAN'T DELETE IF ALL THAT IS LEFT ARE REPRESENTATIVES
        //CAN'T DELETE THEMSELVES
        $stripePersonDelete->handle($stripe_id);

        return redirect()->route('admin.gateway.persons.index');
    }

    public function banksIndex(StripeBanksList $stripeBanksList)
    {
        $banks = $stripeBanksList->handle();

        return view('admin.settings.gateway.banks.index')
            ->withBanks($banks);
    }

    public function banksCreate()
    {}

    public function banksStore(Request $request, StripeBankCreate $stripeBankCreate)
    {
        $bank = $stripeBankCreate->handle($request);

        Bank::create(
            [
                'company_id' => Auth::user()->company->id,
                'stripe_id' => $bank->id,
                'split' => 100,
                'split_type' => 'percent',
            ]
        );

        return redirect()->route('admin.gateway.banks.edit', $bank);
    }

    public function banksShow(Bank $bank, StripeBankRetrieve $stripeBankRetrieve)
    {}

    public function banksEdit(Bank $bank, StripeBankRetrieve $stripeBankRetrieve)
    {}

    public function banksUpdate(Bank $bank, Request $request, StripeBankUpdate $stripeBankUpdate)
    {}

    public function banksDelete(Bank $bank, StripeBankDelete $stripeBankDelete)
    {}
}
