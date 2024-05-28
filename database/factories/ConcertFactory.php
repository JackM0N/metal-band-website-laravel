<?php

namespace Database\Factories;

use App\Models\Tour;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ConcertFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array{   
        return [
            'date' => $this->faker->dateTimeBetween('- 8 weeks', '- 4 week'),
            'country' => $this->faker->word(), 
            'city' => $this->faker->word(), 
            'place' => $this->faker->word(),
            'tour_id'=> Tour::select('id')->orderByRaw("RAND()")->first()->id, 
            'created_at' => $this->faker->dateTimeBetween('- 8 weeks', '- 4 week'),
            'updated_at' => $this->faker->dateTimeBetween('- 4 weeks', '- 1 week'),
            'deleted_at' => rand(0,10) === 0 
            ? $this->faker->dateTimeBetween('- 4 weeks', '- 1 week')
            : null
        ];
    }
}
