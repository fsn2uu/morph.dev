<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateTable extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'complex_id',
        'unit_id',
        'name',
    ];

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }
}
