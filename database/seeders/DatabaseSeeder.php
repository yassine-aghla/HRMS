<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Employe;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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


      
}
