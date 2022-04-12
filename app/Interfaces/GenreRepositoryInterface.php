<?php

namespace App\Interfaces;

interface GenreRepositoryInterface
{
    public function getAllGenres();
    public function getAllGenresSorted($asc);
    public function getAllGenresMovies();
    public function searchGenre($genreName,$genreYear);

    public function getGenreById($GenreId);
    public function deleteGenre($GenreId);
    public function createGenre(array $GenreDetails);
    public function updateGenre($GenreId, array $newDetails);
    public function getFulfilledGenres();
}
