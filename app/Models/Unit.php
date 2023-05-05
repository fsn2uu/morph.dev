<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Scopes\MineScope;

use App\Models\Reservation;

class Unit extends Model
{
    use HasFactory;

    protected $guarded  = [];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new MineScope);

        Unit::creating(function($model){
            $model->slug = Str::of($model->name)->slug('-');
            if(!property_exists($model, 'company_id'))
            {
                $model->company_id = Auth::user()->company_id;
            }

            $stripe = new \Stripe\StripeClient(
                env('STRIPE_SECRET')
            );
    
            $subscriptions = $stripe->subscriptions->all(['customer' => Auth::user()->company->stripe_id]);
            $price = $stripe->plans->retrieve(
                $subscriptions['data'][0]['plan']['id'],
                []
            );

            //NEED TO GET THIS REDIRECTED TO A CUSTOM ERROR PAGE WITH A CHANCE TO UPGRADE THE PACKAGE
            return $price['metadata']['unit_limit'] >= Auth::user()->company->units->count();
        });
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }


    public function pics()
    {
        return $this->morphMany(Pic::class, 'picable')->orderBy('order');
    }

    public function rateTable()
    {
        return $this->belongsTo(RateTable::class);
    }

    public function scopeReservation($query, $start_date = null, $end_date = null)
    {
        if ($start_date && $end_date) {
            $query->whereRelation('reservations', function ($subquery) use ($start_date, $end_date) {
                $subquery->where('start_date', '<=', $end_date)
                        ->where('end_date', '>=', $start_date);
            });
        }
    }

    public function scopeSearch($query, $start_date = null, $end_date = null, $beds = null, $baths = null, $sleeps = null, $amenities = null, $id=null)
    {
        if ($start_date && $end_date) {
            $query->whereDoesntHave('reservations', function ($subquery) use ($start_date, $end_date) {
                $subquery->where('start_date', '<=', $end_date)
                        ->where('end_date', '>=', $start_date);
            });
        }
        
        if ($beds) {
            $query->where('beds', $beds);
        }
        
        if ($baths) {
            $query->where('baths', $baths);
        }
        
        if ($sleeps) {
            $query->where('sleeps', $sleeps);
        }

        if($id)
        {
            $query->where('id', $id);
        }
        
        if ($amenities) {
            foreach ($amenities as $amenity) {
                $query->whereHas('amenities', function ($subquery) use ($amenity) {
                    $subquery->where('name', $amenity);
                });
            }
        }
        
        return $query;
    }

    public function fees()
    {
        return $this->morphMany(Fee::class, 'feeable');
    }

}
