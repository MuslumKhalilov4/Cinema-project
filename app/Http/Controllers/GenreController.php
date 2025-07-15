<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function showAll(): JsonResponse
    {
        $genres = Genre::all();

        if($genres->isEmpty()){
            return response()->json([
                'success' => false,
                'message' => 'No items found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $genres
        ], 200);
    }

    public function showSingle($id): JsonResponse
    {
        $genre = Genre::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $genre
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $vaildated = $request->validate([
            'name' => 'required|string|max:25'
        ]);

        $genre = Genre::create([
            'name' => $vaildated['name']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Genre created successfully',
            'data' => $genre
        ], 201);
    }

    public function update($id, Request $request): JsonResponse
    {
        $genre = Genre::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:25'
        ]);

        $genre->update([
            'name' => $validated['name']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Genre updated successfully',
            'data' => $genre
        ], 200);
    }

    public function delete($id):JsonResponse
    {
        $genre = Genre::findOrFail($id);

        $genre->delete();

        return response()->json([
            'success' => true,
            'message' => 'Genre deleted successfully',
            'data' => $genre
        ]);
    }
}
