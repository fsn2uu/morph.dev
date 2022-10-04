<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Scopes\MineScope;

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
            $model->company_id = Auth::user()->company_id;
        });
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class);
    }

    public function pics()
    {
        return $this->morphMany(Pic::class, 'picable');
    }
}
