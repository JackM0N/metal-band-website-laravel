<?php

namespace Database\Seeders;

use App\Models\Tour;
use App\Models\Concert;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConcertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tours = Tour::all();
        Concert::factory()
            ->count(500)
            ->create()
            ->each(function ($song) use ($tours){
                $song->update(['tour_id'=>$tours->random()->id]);
        });
    }
}
