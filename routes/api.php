<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MovieController;
use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('genre')->group(function(){
    Route::get('/', [GenreController::class, 'showAll']);
    Route::get('/{id}', [GenreController::class, 'showSingle']);
    Route::post('/store', [GenreController::class, 'store']);
    Route::put('/edit/{id}', [GenreController::class, 'edit']);
    Route::delete('/destroy/{id}', [GenreController::class, 'destroy']);
});

Route::prefix('actor')->group(function(){
    Route::get('/', [ActorController::class, 'showAll']);
    Route::get('/{id}', [ActorController::class, 'showSingle']);
    Route::post('/store', [ActorController::class, 'store']);
    Route::put('/edit/{id}', [ActorController::class, 'edit']);
    Route::delete('/destroy/{id}', [ActorController::class, 'destroy']);
});

Route::prefix('movie')->group(function(){
    Route::get('/', [MovieController::class, 'showAll']);
    Route::get('/{id}', [MovieController::class, 'showSingle']);
    Route::post('/store', [MovieController::class, 'store']);
    Route::put('/edit/{id}', [MovieController::class, 'edit']);
    Route::delete('/destroy/{id}', [MovieController::class, 'destroy']);
});

Route::prefix('language')->group(function(){
    Route::get('/', [LanguageController::class, 'getAll']);
    Route::get('/{id}', [LanguageController::class, 'getSingle']);
    Route::post('/store', [LanguageController::class, 'store']);
    Route::put('/edit/[id}', [LanguageController::class, 'edit']);
    Route::delete('/destroy/{id}', [LanguageController::class, 'destroy']);
});

Route::get('send-mail', function(){
    $data = ['title' => 'Salam', 'body' => 'test content'];

    Mail::to()->send(new TestMail($data));

    return response()->json(['message' => 'Mail send successfully']);
});
