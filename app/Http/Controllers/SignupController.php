<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StripeService;
use App\Http\Requests\SignupRequest;
use Illuminate\Support\Facades\Auth;

class SignupController extends Controller
{
    public function create(Request $request)
    {
        //dd($request->session());
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
          );
        $prices = $stripe->prices->all(['product' => 'prod_FUlzlKIq6OhRKP']);
    
        return view('signup')
            ->withPrices($prices);
    }

    public function store(SignupRequest $request, StripeService $service)
    {
        $user = $service->handle($request);

        Auth::login($user);

        return redirect()->route('admin.dashboard');
    }
}
