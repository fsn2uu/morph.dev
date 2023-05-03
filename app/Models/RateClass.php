<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateClass extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function neighborhoods()
    {
        return $this->hasMany(Neighbohood::class);
    }

    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    public function rates()
    {
        return $this->hasOne(Rate::class);
    }
}
