## WEB.PHP

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
    Route::resource('recuperations', RecuperationController::class)->only(['index', 'create', 'store']);
   

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
    Route::get('/recuperations/rh', [RecuperationController::class, 'indexRH'])->name('recuperations.index_rh');
      Route::resource('employes', EmployeController::class);
    Route::post('/recuperations/{id}/valider', [RecuperationController::class, 'validerRH'])->name('recuperations.valider');
    Route::post('/recuperations/{id}/refuser', [RecuperationController::class, 'refuserRH'])->name('recuperations.refuser');
    // Route::resource('grades', GradeController::class);
     Route::get('/employe/{id}/carriere', [CarriereController::class, 'show'])->name('employe.carriere');
    Route::get('/employe/{id}/carriere/edit', [CarriereController::class, 'edit'])->name('employe.carriere.edit');
    Route::put('/employe/{id}/carriere/update', [CarriereController::class, 'update'])->name('employe.carriere.update');
});



Route::middleware('role:Admin')->group(function(){
    Route::resource('departments', DepartmentController::class);
    //  Route::resource('formations', FormationController::class);
    // Route::resource('contrats', ContratController::class);
    Route::resource('emplois', EmploiController::class);
    //  Route::resource('grades', GradeController::class);
   Route::get('/organigramme', [EmployeController::class, 'organigramme'])->name('employes.organigramme');
   
});



### SEEDERS
## DATABASE SEEDER
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['Admin', 'HR', 'Manager', 'Employé'];
        foreach ($roles as $role) {
            if (!Role::where('name', $role)->exists()) {
                Role::create(['name' => $role]);
            }
        }

        
        $permissions = ['manage_departments', 'manage_formations', 'manage_contrats', 'manage_grades','manage_emploi','manage_employe'];
        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }

        
        $user = User::find(1); 
        $user->assignRole('Admin');
        $admin = Role::findByName('admin');
        $admin->givePermissionTo(['manage_departments', 'manage_formations', 'manage_contrats', 'manage_grades','manage_emploi','manage_emploi']);
        $rh = Role::findByName('HR');
        $rh->givePermissionTo(['manage_formations', 'manage_contrats', 'manage_grades']);

        $manager = Role::findByName('manager');
        $manager->givePermissionTo(['manage_grades']);

        $this->call([
            DepartmentSeeder::class,
            UserSeeder::class,
            FormationSeeder::class,
            EmploiSeeder::class,
        ]);
    }





