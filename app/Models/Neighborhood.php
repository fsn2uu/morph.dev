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
        });
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
