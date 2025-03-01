<?php

namespace Database\Factories;
use App\Models\Grade;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Grade>
 */
class GradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->date();
        $endDate = $this->faker->optional()->date('Y-m-d', strtotime($startDate . ' +1 year'));

        return [
            'name' => $this->faker->word(),
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];
    }
}
