<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tour>
 */
class TourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->word(100),
            'startDate' => $this->faker->dateTimeBetween('- 10 weeks', '- 5 week'), 
            'endDate' => $this->faker->dateTimeBetween('+ 5 weeks', '+ 10 week'),
            'created_at' => $this->faker->dateTimeBetween('- 12 weeks', '- 10 week'),
            'updated_at' => $this->faker->dateTimeBetween('- 10 weeks', '- 1 week'),
            'deleted_at' => rand(0,10) === 0 
            ? $this->faker->dateTimeBetween('- 4 weeks', '- 1 week')
            : null
        ];
    }
}
