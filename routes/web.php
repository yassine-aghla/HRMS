<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\ContratController;
use App\Http\Controllers\EmploiController;
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
});

Route::resource('departments', DepartmentController::class);
Route::resource('formations', FormationController::class);
Route::resource('contrats', ContratController::class);
Route::resource('emplois', EmploiController::class);


require __DIR__.'/auth.php';
