<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NeighborhoodController;

Route::apiResource('neighborhoods', NeighborhoodController::class);
