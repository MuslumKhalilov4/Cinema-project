<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HallController extends Controller
{
    public function getAll(): JsonResponse
    {
        $hall = Hall::all();

        return response()->json([
            'success' => true,
            'data' => $hall
        ], 200);
    }

    public function getSingle($id): JsonResponse
    {
        $hall = Hall::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $hall
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate(['name' => 'required|string|max:50']);

        $hall = Hall::create($request);

        return response()->json([
            'success' => true,
            'message' => 'Hall created successfully',
            'data' => $hall
        ], 201);
    }

    public function edit(Request $request, $id): JsonResponse
    {
        $validated = $request->validate(['name' => 'required|string|max:50']);

        $hall = Hall::findOrFail($id);

        $hall->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Hall updated successfully',
            'data' => $hall
        ], 200);
    }

    public function destroy($id): JsonResponse
    {
        $hall = Hall::findOrFail($id);

        $hall->delete();

        return response()->json([
            'success' => true,
            'message' => 'Hall deleted successfully',
            'data' => $hall
        ], 200);
    }
}
