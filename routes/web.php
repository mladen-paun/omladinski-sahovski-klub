<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('kategorijas', App\Http\Controllers\KategorijaController::class);
    Route::resource('clans', App\Http\Controllers\ClanController::class);
    Route::resource('treners', App\Http\Controllers\TrenerController::class);
    Route::resource('lekcijas', App\Http\Controllers\LekcijaController::class);

});

require __DIR__.'/auth.php';