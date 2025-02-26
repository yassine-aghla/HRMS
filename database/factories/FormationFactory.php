<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Formation;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Formation>
 */
class FormationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titre' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'prix' => $this->faker->randomFloat(2, 50, 1000),
            'date_debut' => $this->faker->date(),
            'date_fin' => $this->faker->optional()->date(),
            'niveau' => $this->faker->randomElement(['Débutant', 'Intermédiaire', 'Avancé']),
            'duree' => $this->faker->numberBetween(5, 100),
        ];
    }
}
