<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\MineScope;

class Neighborhood extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new MineScope);
    }

    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    public function pics()
    {
        return $this->morphMany(Pic::class, 'picable');
    }
}
