<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class LanguageController extends Controller
{
    public function getAll(){
        $languages = Language::all();

        return response()->json([
            'success' => true,
            'data' => $languages
        ]);
    }

    public function getSingle($id){
        $language = Language::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $language
        ]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:50'
        ]);

        $language = Language::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Language created successfully',
            'data' => $language
        ]);
    }

    public function edit(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required|string|max:50'
        ]);

        $language = Language::findOrFail($id);

        $language->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Language updated successfully',
            'data' => $language  
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $language = Language::findOrFail($id);

        $language->delete();

        return response()->json([
            'success' => true,
            'message' => 'Language updated successfully',
            'data' => $language
        ]);
    }
}
