<?php

namespace App\Models;

use App\Scopes\MineScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Special extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new MineScope);

        Special::creating(function($model){
            $model->company_id = Auth::user()->company->id;
        });
    }

    public function scopeSearch($query, Request $request)
    {
        foreach($request->except(['_token']) as $k => $v)
        {
            if(!empty($v)):
                $query->where($k, $v);
            endif;
        }
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
