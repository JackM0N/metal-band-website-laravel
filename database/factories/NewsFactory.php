<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->word(200),
            'contents' => $this->faker->text(), 
            'created_at' => $this->faker->dateTimeBetween('- 8 weeks', '- 4 week'),
            'updated_at' => $this->faker->dateTimeBetween('- 4 weeks', '- 1 week'),
            'deleted_at' => rand(0,10) === 0 
            ? $this->faker->dateTimeBetween('- 4 weeks', '- 1 week')
            : null
        ];
    }
}
