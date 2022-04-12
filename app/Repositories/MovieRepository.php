<?php

namespace App\Repositories;

use App\Interfaces\MovieRepositoryInterface;
use App\Models\Genre;
use App\Models\Movie;

class MovieRepository implements MovieRepositoryInterface
{
    public function getAllMovies()
    {
        return Movie::all();
    }

    public function getAllMoviesSorted($asc)
    {
        if ($asc) {
            $movies = Movie::all()->sortBy('name');
        } else {
            $movies = Movie::all()->sortByDesc('name');
        }

        return $movies;
    }

    public function getMovieById($MovieId)
    {
        return Movie::findOrFail($MovieId);
    }

    public function deleteMovie($MovieId)
    {
        Movie::destroy($MovieId);
    }

    public function createMovie(array $MovieDetails)
    {
        return Movie::create($MovieDetails);
    }

    public function searchMovie($movieName, $movieYear)
    {

        return Movie::where('name', 'LIKE', '%' . $movieName . '%')->where('year', 'LIKE', '%' . $movieYear . '%')->get();
    }

    public function updateMovie($MovieId, array $newDetails)
    {
        return Movie::whereId($MovieId)->update($newDetails);
    }

    public function getFulfilledMovies()
    {
        return Movie::where('is_fulfilled', true);
    }
}
