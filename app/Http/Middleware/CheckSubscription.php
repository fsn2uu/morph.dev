<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;

class CheckSubscription
{
    public function handle($request, Closure $next)
    {
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        $subscriptions = $stripe->subscriptions->all(['customer' => Auth::user()->company->stripe_id]);

        if (sizeof($subscriptions['data'])<1) {
            // User doesn't have an active subscription
            session()->flash('expired', 'Your subscription has expired or has been removed.  The functionality of '. env('APP_NAME') .' will be restricted until your subscription is restored.');
        }

        return $next($request);
    }
}
