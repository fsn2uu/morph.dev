<?php

namespace App\Models;

use App\Scopes\MineScope;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new MineScope);

        Task::creating(function($model){
            $model->company_id = Auth::user()->company_id;
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
}
