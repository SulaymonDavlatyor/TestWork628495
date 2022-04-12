<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => ['ApiKey']], function () {
    //genres
    Route::post('genres/access_key={apikey?}', [GenreController::class, 'index']);
    Route::post('genres/sort/{sort}/access_key={apikey?}', [GenreController::class, 'getAllSorted']);
    Route::post('genres/{id}/access_key={apikey?}', [GenreController::class, 'show']);
    Route::post('genres/search/{name}/{year}/access_key={apikey?}', [GenreController::class, 'search']);
    Route::post('all/access_key={apikey?}', [GenreController::class, 'all']);
    Route::post('genres/{id}', [GenreController::class, 'show']);

    //movies
    Route::post('movies/access_key={apikey?}', [MovieController::class, 'index']);
    Route::post('movies/search/{name}/{year}/access_key={apikey?}', [MovieController::class, 'search']);
    Route::post('movies/sort/{sort}/access_key={apikey?}', [MovieController::class, 'getAllSorted']);
    Route::post('movies/{id}/access_key={apikey?}', [MovieController::class, 'show']);
    Route::post('movies/{id}', [MovieController::class, 'show']);


});

//Route::get('genres', [GenreController::class, 'index']);
//Route::post('genres/access_key={apikey?}', [GenreController::class,'index'])->middleware('ApiKey');
//Route::get('/genres', [GenreController::class,'index'])->middleware('ApiKey');


//Route::get('genres/{id}', [GenreController::class, 'show']);

//Route::post('genres', [GenreController::class, 'store']);
//Route::put('genres/{id}', [GenreController::class, 'update']);
//Route::delete('genres/{id}', [GenreController::class, 'delete']);
