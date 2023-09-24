<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Ejmplo de aplicar el rol con middleware
    // Route::get('/chirps', [ChirpController::class, 'index'])->middleware('can:users.index')->name('chirps.index');
    Route::get('/chirps', [ChirpController::class, 'index'])->name('chirps.index');
    Route::post('/chirps', [ChirpController::class, 'store'])->name('chirps.store');
    Route::get('/chirps/datatable', [ChirpController::class, 'show'])->name('chirps.show');
    Route::put('/chirps/{id}', [ChirpController::class, 'update'])->name('chirps.update');
    Route::delete('/chirps/{id}/destroy', [ChirpController::class, 'destroy'])->name('chirps.destroy');
});

require __DIR__ . '/auth.php';
