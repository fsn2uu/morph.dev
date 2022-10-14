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

    public function scopeAvailable($query, $value = [])
    {
        // There is a better way to do this.  We'll need to refactor this query after the reservation system is solid.
        if(@$value['start_date'] && @$value['end_date']):
            $reserved = [];
            $reserves = Reservation::whereBetween('start_date', [$value['start_date'], $value['end_date']])->orWhereBetween('end_date', [$value['start_date'], $value['end_date']])->get();
            foreach($reserves as $res)
            {
                $reserved[] = $res->id;
            }
            return $query->whereNotIn('id', $reserved);
        endif;
    }
}
