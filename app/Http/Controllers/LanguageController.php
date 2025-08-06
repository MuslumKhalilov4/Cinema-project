<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class LanguageController extends Controller
{
    public function getAll(): JsonResponse
    {
        $languages = Language::all();

        return response()->json([
            'success' => true,
            'data' => $languages
        ], 200);
    }

    public function getSingle($id): JsonResponse
    {
        $language = Language::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $language
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50'
        ]);

        $language = Language::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Language created successfully',
            'data' => $language
        ], 201);
    }

    public function edit(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50'
        ]);

        $language = Language::findOrFail($id);

        $language->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Language updated successfully',
            'data' => $language  
        ], 200);
    }

    public function destroy($id): JsonResponse
    {
        $language = Language::findOrFail($id);

        $language->delete();

        return response()->json([
            'success' => true,
            'message' => 'Language updated successfully',
            'data' => $language
        ], 200);
    }
}
