<?php 

namespace App\Services\Interfaces;

use App\Http\Requests\MovieCreateRequest;
use App\Http\Requests\MovieFilterRequest;
use App\Http\Requests\MovieUpdateRequest;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Collection;

interface MovieServiceInterface
{
    public function getAllMovies(MovieFilterRequest $request): Collection;

    public function getMovieById($id): Movie;

    public function createMovie(MovieCreateRequest $request): Movie;

    public function updateMovie(MovieUpdateRequest $request, $id): Movie;

    public function deleteMovie($id): Movie;
}