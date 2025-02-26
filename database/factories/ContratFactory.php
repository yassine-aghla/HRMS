<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\models\Contrat;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contrat>
 */
class ContratFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>$this->faker->randomElement(['CDI', 'CDD', 'Stage']),
        ];
    }
}
