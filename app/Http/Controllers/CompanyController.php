<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Subscription;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $company = Company::where('id', Auth::user()->company_id)->first();

        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );
        $info = $stripe->customers->retrieve(
            $company->stripe_id,
            []
        );

        $banks = $stripe->customers->allSources(
            $company->stripe_id,
            ['object' => 'bank_account']
        );

        $prices = $stripe->prices->all(['product' => 'prod_FUlzlKIq6OhRKP']);

        return view('admin.settings.company')
            ->withPrices($prices)
            ->withInfo($info)
            ->withBanks($banks)
            ->withCompany($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        // Set the API key
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        // Get the Stripe customer object for the user
        $customer = $stripe->customers->retrieve(Auth::user()->company->stripe_id);

        // Get the current subscription object for the user
        if (count($customer->subscriptions->data) > 0) {
            // The customer has at least one subscription, so retrieve the first one
            $subscription = $customer->subscriptions->data[0];
        } else {
            // The customer doesn't have any subscriptions
            $subscription = null;
        }        

        // Set the new subscription level
        $newPlanId = $request->plan;

        // Create a new subscription object with the new plan
        $newSubscription = $customer->subscriptions->create([
            'items' => [
                [
                    'plan' => $newPlanId,
                ],
            ],
        ]);

        // Cancel the old subscription
        if(!empty($subscription)):
            $subscription->cancel();
        endif;

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
