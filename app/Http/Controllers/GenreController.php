<?php

namespace App\Http\Controllers;

use App\Interfaces\GenreRepositoryInterface;
use App\Models\Genre;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

use Illuminate\Http\Request;


class GenreController extends Controller
{
    private GenreRepositoryInterface $GenreRepository;

    public function __construct(GenreRepositoryInterface $GenreRepository)
    {
        $this->GenreRepository = $GenreRepository;
    }

    public function index(): JsonResponse
    {


        return response()->json([
            'data' => $this->GenreRepository->getAllGenres()
        ]);
    }

    public function all(): JsonResponse
    {


        return response()->json([
            'data' => $this->GenreRepository->getAllGenresMovies()
        ]);
    }

    public function getAllSorted(Request $request): JsonResponse
    {
        $sort = $request->route('sort');
        if ($sort == 'asc') {
            $asc = true;
        } else {
            $asc = false;
        }

        return response()->json([
            'data' => $this->GenreRepository->getAllGenresSorted($asc)
        ]);
    }



    //  public function store(Request $request): JsonResponse
    //  {
    //      $GenreDetails = $request->only([
    //          'client',
    //          'details'
    //      ]);
//
    //      return response()->json(
    //          [
    //              'data' => $this->GenreRepository->createGenre($GenreDetails)
    //          ],
    //          Response::HTTP_CREATED
    //      );
    //  }

    public function show(Request $request): JsonResponse
    {
        $GenreId = $request->route('id');

        return response()->json([
            'data' => $this->GenreRepository->getGenreById($GenreId)
        ]);
    }

    public function search(Request $request): JsonResponse
    {
        $name = $request->route('name');
        $year = $request->route('year');

        return response()->json([
            'data' => $this->GenreRepository->searchGenre($name, $year)
        ]);
    }

    public function update(Request $request): JsonResponse
    {
        $GenreId = $request->route('id');
        $GenreDetails = $request->only([
            'client',
            'details'
        ]);

        return response()->json([
            'data' => $this->GenreRepository->updateGenre($GenreId, $GenreDetails)
        ]);
    }

    public function destroy(Request $request): JsonResponse
    {
        $GenreId = $request->route('id');
        $this->GenreRepository->deleteGenre($GenreId);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
