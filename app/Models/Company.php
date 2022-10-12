<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\MineScope;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new MineScope);
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
