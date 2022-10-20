<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Scopes\MineScope;

class Neighborhood extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new MineScope);

        Neighborhood::creating(function($model){
            $model->slug = Str::of($model->name)->slug('-');
            $model->company_id = Auth::user()->company_id;

            $stripe = new \Stripe\StripeClient(
                env('STRIPE_SECRET')
            );
    
            $subscriptions = $stripe->subscriptions->all(['customer' => Auth::user()->company->stripe_id]);
            $price = $stripe->plans->retrieve(
                $subscriptions['data'][0]['plan']['id'],
                []
            );

            //NEED TO GET THIS REDIRECTED TO A CUSTOM ERROR PAGE WITH A CHANCE TO UPGRADE THE PACKAGE
            return $price['metadata']['neighborhood_limit'] >= Auth::user()->company->neighborhoods->count();
        });
    }

    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    public function pics()
    {
        return $this->morphMany(Pic::class, 'picable')->orderBy('order');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
