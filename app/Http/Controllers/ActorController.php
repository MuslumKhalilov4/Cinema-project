<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActorCreateRequest;
use App\Http\Requests\ActorUpdateRequest;
use App\Models\Actor;
use App\Services\FileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActorController extends Controller
{
    
    protected $fileService;

    public function __construct(FileService $fileService1)
    {
        $this->fileService = $fileService1;
    }

    public function showAll(): JsonResponse
    {
        $actors = Actor::all();

        if($actors->isEmpty()){
            return response()->json([
                'success' => false,
                'message' => "No items found"
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $actors
        ], 200);
    }

    public function showSingle($id): JsonResponse
    {
        $actor = Actor::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $actor
        ], 200);
    }

    public function store(ActorCreateRequest $request): JsonResponse
    {
        $actor = Actor::create([
            'full_name' => $request->full_name,
            'birth_date' => $request->birth_date,
            'nationality' => $request->nationality,
            'height' => $request->height,
            'image_path' => $this->fileService->upload($request->image)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Actor created successfully',
            'data' => $actor
        ], 201);
    }

    public function edit($id, ActorUpdateRequest $request): JsonResponse
    {
        $actor = Actor::findOrFail($id);

        $actor->update([
            'full_name' => $request->full_name,
            'birth_date' => $request->birth_date,
            'nationality' => $request->nationality,
            'height' => $request->height,
        ]);

        if($request->image){
            $this->fileService->delete($actor->image_path);
            $actor->image_path = $this->fileService->upload($request->image);

            $actor->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Actor updated successfully',
            'data' => $actor
        ], 200);
    }

    public function destroy($id): JsonResponse
    {
        $actor = Actor::findOrFail($id);

        $this->fileService->delete($actor->image_path);

        $actor->delete();

        return response()->json([
            'success' => true,
            'message' => 'Actor deleted successfully',
            'data' => $actor
        ], 200);
    }
}
