<?php 

namespace App\Services\Interfaces;

use App\Http\Requests\MovieCreateRequest;
use App\Http\Requests\MovieUpdateRequest;
use App\Models\Movie;

interface MovieServiceInterface
{
    public function getMovieById($id): Movie;

    public function createMovie(MovieCreateRequest $request): Movie;

    public function updateMovie(MovieUpdateRequest $request, $id): Movie;

    public function deleteMovie($id): Movie;
}