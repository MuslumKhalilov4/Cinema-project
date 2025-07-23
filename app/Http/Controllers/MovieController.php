<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieCreateRequest;
use App\Http\Requests\MovieUpdateRequest;
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
        ], 201);
    }

    public function edit(MovieUpdateRequest $request, $id): JsonResponse
    {
        $movie = $this->movieService->updateMovie($request, $id);

        return response()->json([
            'success' => true,
            'message' => 'Movie edited successfully',
            'data' => $movie
        ], 200);
    }

    public function destroy($id): JsonResponse
    {
        $movie = $this->movieService->deleteMovie($id);

        return response()->json([
            'success' => true,
            'message' => 'Movie deleted successfully',
            'data' => $movie
        ]);
    }
}
