<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieCreateRequest;
use App\Services\Interfaces\MovieServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    protected $movieService;

    public function __construct(MovieServiceInterface $movieService)
    {
        $this->movieService = $movieService;
    }

    public function showSingle($id): JsonResponse
    {
        $movie = $this->movieService->getMovieById($id);

        return response()->json([
            'success' => true,
            'data' => $movie
        ], 200);
    }

    public function store(MovieCreateRequest $request): JsonResponse
    {
        $movie = $this->movieService->createMovie($request);

        return response()->json([
            'success' => true,
            'message' => 'Movie created successfully',
            'data' => $movie
        ]);
    }
}
