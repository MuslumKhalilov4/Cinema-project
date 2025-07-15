<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\GenreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('genre')->group(function(){
    Route::get('/', [GenreController::class, 'showAll']);
    Route::get('/{id}', [GenreController::class, 'showSingle']);
    Route::post('/store', [GenreController::class, 'store']);
    Route::put('/update/{id}', [GenreController::class, 'update']);
    Route::delete('/delete/{id}', [GenreController::class, 'delete']);
});

Route::prefix('actor')->group(function(){
    Route::get('/', [ActorController::class, 'showAll']);
    Route::get('/{id}', [ActorController::class, 'showSingle']);
    Route::post('/store', [ActorController::class, 'store']);
    Route::put('/update/{id}', [ActorController::class, 'update']);
    Route::delete('/delete/{id}', [ActorController::class, 'delete']);
});
