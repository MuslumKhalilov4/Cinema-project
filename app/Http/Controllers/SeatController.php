<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function getAll(): JsonResponse
    {
        $seats = Seat::all();

        return response()->json([
            'success' => true,
            'data' => $seats
        ], 200);
    }

    public function getSingle($id): JsonResponse
    {
        $seat = Seat::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $seat
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'row' => 'required|integer|min:1',
            'number' => 'required|integer|min:1',
            'is_reserved' => 'required|boolean',
            'hall_id' => 'required|integer|exists:halls,id|min:1'
        ]);

        $seat = Seat::create($request);

        return response()->json([
            'success' => true,
            'message' => 'Seat created successfully',
            'data' => $seat
        ], 201);
    }

    public function edit(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'row' => 'required|integer|min:1',
            'number' => 'required|integer|min:1',
            'is_reserved' => 'required|boolean',
            'hall_id' => 'required|integer|exists:halls,id|min:1'
        ]);

        $seat = Seat::findOrFail($id);

        $seat->update($request);

        return response()->json([
            'success' => true,
            'message' => 'Seat updated successfully',
            'data' => $seat
        ], 200);
    }

    public function destroy($id): JsonResponse
    {
        $seat = Seat::findOrFail($id);

        $seat->delete();

        return response()->json([
            'success' => true,
            'message' => 'Seat deleted successfully',
            'data' => $seat
        ], 200);
    }
}
