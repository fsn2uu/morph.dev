<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Traveler extends Model
{
    protected $fillable = [
        'first',
        'last',
        'email',
        'phone',
        'phone2',
        'address',
        'address2',
        'city',
        'state',
        'zip',
        'stripe_customer_id',
    ];

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }
}
