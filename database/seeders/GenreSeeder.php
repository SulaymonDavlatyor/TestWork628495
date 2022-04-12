<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use Database\Factories\GenreFactory;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Genre::factory(10)->create();
        foreach(Genre::all() as $genre){
            $movies = Movie::inRandomOrder()->take(rand(1,3))->pluck('id');
            $genre->movies()->attach($movies);
        }
    }
}
