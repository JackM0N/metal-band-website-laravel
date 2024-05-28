<?php

namespace Database\Factories;

use App\Models\Album;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        $duration = $this->faker->numberBetween(60, 600);
        
        return [
            'title' => $this->faker->word(), 
            'duration' => Carbon::createFromTimestamp($duration)->format('i:s'),
            'album_id' => Album::select('id')->orderByRaw("RAND()")->first()->id, 
            'created_at' => $this->faker->dateTimeBetween('- 8 weeks', '- 4 week'),
            'updated_at' => $this->faker->dateTimeBetween('- 4 weeks', '- 1 week'),
            'deleted_at' => rand(0,10) === 0 
            ? $this->faker->dateTimeBetween('- 4 weeks', '- 1 week')
            : null
        ];
    }
}
