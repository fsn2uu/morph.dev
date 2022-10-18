<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\MineScope;

class RateTable extends Model
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new MineScope);
    }

    protected $fillable = [
        'company_id',
        'neighborhood_id',
        'unit_id',
        'name',
    ];

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function neighborhoods()
    {
        return $this->belongsTo(Neighborhood::class);
    }

    public function units()
    {
        return $this->belongsTo(Unit::class);
    }
}
