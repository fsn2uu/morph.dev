<?php

namespace App\Scopes;
 
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class MineScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (!$model->hasGlobalScope('mine') && Auth::check() && Auth::user()->company_id)
        {
            $builder->where('company_id', Auth::user()->company_id);
        }
    }
}