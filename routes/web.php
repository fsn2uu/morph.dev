<?php

use App\Models\Unit;
use App\Services\BarefootService;
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
use App\Http\Controllers\RateClassController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\NeighborhoodController;
use App\Http\Controllers\Settings\Gateway\BankController;
use App\Http\Controllers\Settings\Gateway\PersonController;
use App\Http\Controllers\Settings\Gateway\TransferController;

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
                $units = Unit::reservation(\Carbon\Carbon::now(), \Carbon\Carbon::now()->addDays(14))->get();

                return view('admin.dashboard')
                    ->withUnits($units);
            })->name('dashboard');

            Route::get('/test', function(BarefootService $barefootService){
                $barefootService->importProperties();
            });

            Route::resource('neighborhoods', NeighborhoodController::class);
            Route::controller(NeighborhoodController::class)->group(function () {
                Route::get('/neighborhoods/{neighborhood}/mass-assign-units', 'massAssignGet')->name('neighborhoods.massAssign');
                Route::post('/neighborhoods/{neighborhood}/mass-assign-units', 'massAssignPost')->name('neighborhoods.massAssignPost');
            });
            Route::resource('units', UnitController::class);
            Route::resource('users', UserController::class);
            Route::resource('travelers', TravelerController::class);
            Route::resource('reservations', ReservationController::class);
            Route::resource('rates', RateController::class);
            Route::resource('rate_classes', RateClassController::class);
            Route::resource('specials', SpecialController::class);
            Route::resource('tasks', TaskController::class);
            Route::resource('amenities', AmenityController::class);
            Route::prefix('settings')->name('settings.')->group(function(){
                Route::controller(CompanyController::class)->group(function () {
                    Route::get('company', 'edit')->name('company');
                    Route::post('company', 'update')->name('company');
                });
                Route::prefix('payment-gateway')->name('gateway.')->group(function(){
                    Route::get('/', function(){
                        return view('admin.settings.gateway.index');
                    })->name('index');
                    Route::resource('banks', BankController::class);
                    Route::resource('persons', PersonController::class);
                    Route::resource('transfers', TransferController::class)->only(['index', 'show']);
                });
            });
        });
    });
});

require __DIR__.'/auth.php';
