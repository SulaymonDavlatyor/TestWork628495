<?php

namespace App\Http\Controllers;

use App\Interfaces\MovieRepositoryInterface;
use App\Models\Movie;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MovieController extends Controller
{
    private MovieRepositoryInterface $MovieRepository;

    public function __construct(MovieRepositoryInterface $MovieRepository)
    {
        $this->MovieRepository = $MovieRepository;
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'data' => $this->MovieRepository->getAllMovies()
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
            'data' => $this->MovieRepository->getAllMoviesSorted($asc)
        ]);
    }

    public function search(Request $request): JsonResponse
    {
        $name = $request->route('name');
        $year = $request->route('year');

        return response()->json([
            'data' => $this->MovieRepository->searchMovie($name, $year)
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $MovieDetails = $request->only([
            'client',
            'details'
        ]);

        return response()->json(
            [
                'data' => $this->MovieRepository->createMovie($MovieDetails)
            ],
            Response::HTTP_CREATED
        );
    }

    public function show(Request $request): JsonResponse
    {
        $MovieId = $request->route('id');

        return response()->json([
            'data' => $this->MovieRepository->getMovieById($MovieId)
        ]);
    }

    public function update(Request $request): JsonResponse
    {
        $MovieId = $request->route('id');
        $MovieDetails = $request->only([
            'client',
            'details'
        ]);

        return response()->json([
            'data' => $this->MovieRepository->updateMovie($MovieId, $MovieDetails)
        ]);
    }

    public function destroy(Request $request): JsonResponse
    {
        $MovieId = $request->route('id');
        $this->MovieRepository->deleteMovie($MovieId);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
