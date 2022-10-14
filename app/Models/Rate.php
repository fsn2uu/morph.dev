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

    public function rate_table()
    {
        return $this->belongsTo(RateTable::class);
    }
}
