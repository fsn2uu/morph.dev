<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RateController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\AmenityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\GatewayController;
use App\Http\Controllers\SpecialController;
use App\Http\Controllers\TravelerController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\NeighborhoodController;

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
            Route::resource('specials', SpecialController::class);
            Route::resource('tasks', TaskController::class);
            Route::resource('amenities', AmenityController::class);
            Route::prefix('settings')->group(function(){
                Route::controller(CompanyController::class)->group(function () {
                    Route::get('company', 'edit')->name('settings.company');
                    Route::post('company', 'update')->name('settings.company');
                });
            });
            Route::prefix('payment-gateway-settings')->group(function(){
                Route::prefix('persons')->group(function(){
                    Route::controller(GatewayController::class)->group(function(){
                    Route::get('/', 'personsIndex')->name('gateway.persons.index');
                    Route::get('/create', 'personsCreate')->name('gateway.persons.create');
                    Route::post('/create', 'personsStore')->name('gateway.persons.store');
                    Route::get('/{user}', 'personsShow')->name('gateway.persons.show');
                    Route::get('/{user}/edit', 'personsEdit')->name('gateway.persons.edit');
                    Route::patch('/{user}/update', 'personsUpdate')->name('gateway.persons.update');
                    Route::delete('/{user}', 'personsDelete')->name('gateway.persons.destroy');
                    });
                });
                Route::prefix('banks')->group(function(){
                    Route::controller(GatewayController::class)->group(function(){
                    Route::get('/', 'banksIndex')->name('gateway.banks.index');
                    Route::get('/create', 'banksCreate')->name('gateway.banks.create');
                    Route::post('/create', 'banksStore')->name('gateway.banks.store');
                    Route::get('/{user}/edit', 'banksEdit')->name('gateway.banks.edit');
                    Route::patch('/{user}/update', 'banksUpdate')->name('gateway.banks.update');
                    Route::delete('/{user}', 'banksDelete')->name('gateway.banks.destroy');
                    });
                });
            });
        });
    });
});

require __DIR__.'/auth.php';
