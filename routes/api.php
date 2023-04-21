<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AmenityController;
use App\Http\Controllers\Api\NeighborhoodController;

Route::prefix('v1')->group(function(){
    Route::apiResource('neighborhoods', NeighborhoodController::class);
    Route::apiResource('amenities', AmenityController::class);
});
