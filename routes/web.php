<?php

use App\Models\Flight;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', [FlightController::class, 'search'])->name('search');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $flights = Flight::all();
        return Inertia::render('FlightList', [
        'flights' => $flights
        ]);
    })->name('dashboard');
    Route::post('/flights', [FlightController::class, 'store'])->name('flights');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
