<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NeighborhoodController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\TravelerController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\RateController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::controller(SignupController::class)->group(function(){
    Route::get('signup', 'create')->name('signup');
    Route::post('signup', 'store')->name('signup.store');
});

Route::get('features', function () {
    return view('features');
})->name('features');

Route::get('about-morph', function () {
    return view('about');
})->name('about');

Route::get('contact-us', function () {
    return view('contact');
})->name('contact');

Route::get('frequently-asked-questions', function () {
    return view('faq');
})->name('faq');

Route::get('morph-terms-of-service', function () {
    return view('tos');
})->name('tos');

Route::get('plans', function () {
    return view('plans');
})->name('plans');

Route::middleware(['auth'])->group(function(){
    Route::name('admin.')->group(function(){
        Route::prefix('admin')->group(function(){
            Route::get('/', function(){
                return view('admin.dashboard');
            })->name('dashboard');
            Route::resource('neighborhoods', NeighborhoodController::class);
            Route::resource('units', UnitController::class);
            Route::resource('users', UserController::class);
            Route::resource('travelers', TravelerController::class);
            Route::resource('reservations', ReservationController::class);
            Route::resource('rates', RateController::class);
            Route::prefix('settings')->group(function(){
                Route::controller(CompanyController::class)->group(function () {
                    Route::get('company', 'edit')->name('settings.company');
                });
            });
        });
    });
});

require __DIR__.'/auth.php';
