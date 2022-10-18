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
}
