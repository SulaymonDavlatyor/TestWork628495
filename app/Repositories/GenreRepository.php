<?php

namespace App\Repositories;

use App\Interfaces\GenreRepositoryInterface;
use App\Models\Genre;

class GenreRepository implements GenreRepositoryInterface
{
    public function getAllGenres()
    {
        return Genre::all();
    }

    public function getAllGenresMovies()
    {
        $genres = Genre::with('movies')->get();

        return $genres;
    }

    public function getAllGenresSorted($asc)
    {
        if ($asc) {
            $genres = Genre::all()->sortBy('name');
        } else {
            $genres = Genre::all()->sortByDesc('name');
        }


        return $genres;
    }

    public function getGenreById($GenreId)
    {
        return Genre::findOrFail($GenreId);
    }

    public function searchGenre($genreName, $genreYear)
    {

        return Genre::where('name', 'LIKE', '%' . $genreName . '%')->where('year', 'LIKE', '%' . $genreYear . '%')->get();
    }

    public function deleteGenre($GenreId)
    {
        Genre::destroy($GenreId);
    }

    public function createGenre(array $GenreDetails)
    {
        return Genre::create($GenreDetails);
    }

    public function updateGenre($GenreId, array $newDetails)
    {
        return Genre::whereId($GenreId)->update($newDetails);
    }

    public function getFulfilledGenres()
    {
        return Genre::where('is_fulfilled', true);
    }
}
