<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'rate_table_id',
        'name',
        'start_date',
        'end_date',
        'amount',
    ];

    public static function boot()
    {
        parent::boot();

        Rate::creating(function($model){
            $model->amount = (int)filter_var($model->amount, FILTER_SANITIZE_NUMBER_INT);
        });
    }

    public function rate_table()
    {
        return $this->belongsTo(RateTable::class);
    }
}
