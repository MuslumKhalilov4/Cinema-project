<?php 

namespace App\Services\Interfaces;

use App\Http\Requests\MovieCreateRequest;
use App\Models\Movie;

interface MovieServiceInterface
{
    public function getMovieById($id): Movie;

    public function createMovie(MovieCreateRequest $request): Movie;
}