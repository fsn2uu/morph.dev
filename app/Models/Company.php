<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\MineScope;
use Illuminate\Support\Str;

use Laravel\Cashier\Billable;

class Company extends Model
{
    use HasFactory, Billable;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        Company::creating(function($model){
            $model->api_token = time() . Str::random(54);
        });
    }

    public function pics()
    {
        return $this->morphMany(Pic::class, 'picable');
    }

    public function travelers()
    {
        return $this->belongsToMany(Traveler::class)->orderBy('last');
    }

    public function neighborhoods()
    {
        return $this->hasMany(Neighborhood::class);
    }

    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    public function rate_table()
    {
        return $this->hasOne(RateTable::class);
    }

    public function hasStripeSubscription($nickname)
    {
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );
        $info = $stripe->customers->retrieve(
            $this->stripe_id,
            []
        );
        
        foreach ($info['subscriptions'] as $k => $subscription)
        {
            if ($subscription['status'] === 'active' && $subscription['items']['data'][$k]['plan']['nickname'] === $nickname)
            {
                return true;
            }
        }

        return false;
    }

    public function fees()
    {
        return $this->morphMany(Fee::class, 'feeable');
    }

}
