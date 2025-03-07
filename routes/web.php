<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\ContratController;
use App\Http\Controllers\EmploiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\CarriereController;
use App\Http\Controllers\CongeController;
Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('role:Admin|HR|Manager|Employé')->group(function(){
    Route::get('/conges/create', [CongeController::class, 'create'])->name('conges.create');
    Route::post('/conges', [CongeController::class, 'store'])->name('conges.store');
    Route::get('/mes-conges', [CongeController::class, 'index_employe'])->name('conges.index_employe');
    Route::delete('/conges/{id}/annuler', [CongeController::class, 'annuler'])->name('conges.annuler');
    Route::get('/conges/solde', [CongeController::class, 'soldeConges'])->name('conges.solde');

});

Route::middleware('role:Admin|HR|Manager')->group(function(){
    Route::resource('grades', GradeController::class);
    Route::get('/conges', [CongeController::class, 'index'])->name('conges.index');
    
    // Route::get('/conges/create', [CongeController::class, 'create'])->name('conges.create');
    // Route::post('/conges', [CongeController::class, 'store'])->name('conges.store');

    Route::patch('/conges/{id}/valider-manager', [CongeController::class, 'validerManager'])->name('conges.validerManager');
    Route::patch('/conges/{id}/valider-rh', [CongeController::class, 'validerRH'])->name('conges.validerRH');
    Route::patch('/conges/{id}/refuser', [CongeController::class, 'refuser'])->name('conges.refuser');
});

Route::middleware('role:Admin|HR')->group(function(){
    Route::resource('formations', FormationController::class);
    Route::resource('contrats', ContratController::class);
    // Route::resource('grades', GradeController::class);
});



Route::middleware('role:Admin')->group(function(){
    Route::resource('departments', DepartmentController::class);
    //  Route::resource('formations', FormationController::class);
    // Route::resource('contrats', ContratController::class);
    Route::resource('emplois', EmploiController::class);
    //  Route::resource('grades', GradeController::class);
    Route::put('/employes/{id}/update-partielle', [EmployeController::class, 'updatePartielle'])->name('employes.updatePartielle');
    Route::resource('employes', EmployeController::class);
    Route::get('/organigramme', [EmployeController::class, 'organigramme'])->name('employes.organigramme');
    Route::get('/employe/{id}/carriere', [CarriereController::class, 'show'])->name('employe.carriere');
    Route::get('/employe/{id}/carriere/edit', [CarriereController::class, 'edit'])->name('employe.carriere.edit');
    Route::put('/employe/{id}/carriere/update', [CarriereController::class, 'update'])->name('employe.carriere.update');
});



require __DIR__.'/auth.php';
