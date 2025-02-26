<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        if (!Role::where('name', 'Admin')->exists()) {
            Role::create(['name' => 'Admin']);
        }
    
        if (!Role::where('name', 'HR')->exists()) {
            Role::create(['name' => 'HR']);
        }
    
        if (!Role::where('name', 'Manager')->exists()) {
            Role::create(['name' => 'Manager']);
        }
    
        if (!Role::where('name', 'Employé')->exists()) {
            Role::create(['name' => 'Employé']);
        }
    
        if (!Permission::where('name', 'manage users')->exists()) {
            Permission::create(['name' => 'manage users']);
        }

        $this->call([
            DepartmentSeeder::class,
            UserSeeder::class,
            FormationSeeder::class,
            EmploiSeeder::class,
        ]);
    }
}
