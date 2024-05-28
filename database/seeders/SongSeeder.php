<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Song;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $albums = Album::all();
        Song::factory()
            ->count(500)
            ->create()
            ->each(function ($song) use ($albums){
                $song->update(["album_id" => $albums->random()->id]);
        });
    }
}
