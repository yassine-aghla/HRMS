<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contrat;
use App\Models\Department;
use App\Models\Formation;
use App\Models\Emploi;
use App\Models\Grade;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employe>
 */
class EmployeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'salaire' => $this->faker->randomFloat(2, 2000, 5000), // Valeur aléatoire entre 2000 et 5000 avec 2 décimales

            // Valeur par défaut pour 'phone' (exemple : un numéro de téléphone fictif)
            'phone' => $this->faker->phoneNumber, // Génère un numéro de téléphone aléatoire
    
            // Valeur par défaut pour 'photo' (exemple : une image fictive)
            'photo' => $this->faker->imageUrl(640, 480, 'people', true), 
            'contrat_id' => Contrat::factory(),
            'department_id' => Department::factory(),
            'emploi_id'=>Emploi::factory(),
            'grade_id'=>Grade::factory(),
        ];
    }

    public function withFormations()
    {
        return $this->has(Formation::factory(), 'formations');
    }
}
