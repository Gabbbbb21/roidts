<?php

use App\Http\Controllers\Web\AuthenticationController;
use App\Http\Controllers\Web\CreateController;
use App\Http\Controllers\Web\FieldpendingController;
use App\Http\Controllers\Web\PendingController;
use App\Http\Controllers\Web\StaffpendingController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::controller(AuthenticationController::class)->group(function () {

    Route::get('/login', 'login')
        ->name('auth.login');

    Route::post('/login', 'authenticate')
        ->name('auth.authenticate');

    Route::post('/logout', 'logout')
        ->name('auth.logout'); 
});

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

        Route::controller(CreateController::class)->group(function () {

            Route::get('/create', 'create')
                ->name('create.create');

            Route::post('/create', 'store')
                ->name('create.store');
        });

        Route::controller(PendingController::class)->group(function() {

            Route::get('/pending', 'index')
                ->name('pending.index');

            Route::put('/pending/{request_id}', 'update')
                ->name('pending.update');

            Route::get('/pending/{requests}/edit', 'edit')
                ->name('pending.edit');

            Route::put('/pending/{request}/forward', 'forward')
                ->name('pending.forward');

            Route::get('/pending/{request_history}/history', 'history')
                ->name('pending.history');
        });
});

// Route::middleware(['auth', 'staff'])->group(function () {

//     Route::controller(StaffpendingController::class)->group(function () {

//         Route::get('/staffpending', 'index')
//             ->name('staffpending.index');

//         Route::get('/staffcreate', 'create')
//             ->name('staffcreate.create');
//     });
// });

// Route::middleware(['auth', 'field'])->group(function () {

//     Route::controller(FieldpendingController::class)->group(function () {

//         Route::get('/fieldpending', 'index')
//             ->name('fieldpending.index');
//     });

// });



require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
