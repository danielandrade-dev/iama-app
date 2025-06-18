<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AnalistController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');

    Route::prefix('analists')->controller(AnalistController::class)->group(function () {
        Route::get('/', 'paginate');
        Route::get('/{id}', 'find');
        Route::post('/', 'create');
        Route::put('/{id}', 'update');
    });
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
