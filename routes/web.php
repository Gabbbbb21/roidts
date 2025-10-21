<?php

use App\Http\Controllers\Web\AuthenticationController;
use App\Http\Controllers\Web\FieldpendingController;
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

Route::middleware(['auth', 'staff'])->group(function () {

    Route::controller(StaffpendingController::class)->group(function () {

        Route::get('/staffpending', 'index')
            ->name('staffpending.index');

        Route::get('/staffcreate', 'create')
            ->name('staffcreate.create');
    });
});

Route::middleware(['auth', 'field'])->group(function () {

    Route::controller(FieldpendingController::class)->group(function () {

        Route::get('/fieldpending', 'index')
            ->name('fieldpending.index');
    });

});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
