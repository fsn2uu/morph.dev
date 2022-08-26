<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NeighborhoodController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('signup', function () {
    return view('signup');
})->name('signup');

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
            Route::prefix('settings')->group(function(){
                Route::controller(CompanyController::class)->group(function () {
                    Route::get('company', 'edit')->name('settings.company');
                });
            });
        });
    });
});

require __DIR__.'/auth.php';
