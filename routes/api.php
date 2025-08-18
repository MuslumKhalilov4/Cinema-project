<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('genre')->group(function () {
    Route::get('/', [GenreController::class, 'showAll']);
    Route::get('/{id}', [GenreController::class, 'showSingle']);
    Route::post('/store', [GenreController::class, 'store']);
    Route::put('/edit/{id}', [GenreController::class, 'edit']);
    Route::delete('/destroy/{id}', [GenreController::class, 'destroy']);
});

Route::prefix('actor')->group(function () {
    Route::get('/', [ActorController::class, 'showAll']);
    Route::get('/{id}', [ActorController::class, 'showSingle']);
    Route::post('/store', [ActorController::class, 'store']);
    Route::put('/edit/{id}', [ActorController::class, 'edit']);
    Route::delete('/destroy/{id}', [ActorController::class, 'destroy']);
});

Route::prefix('movie')->group(function () {
    Route::get('/', [MovieController::class, 'showAll']);
    Route::get('/{id}', [MovieController::class, 'showSingle']);
    Route::post('/store', [MovieController::class, 'store']);
    Route::put('/edit/{id}', [MovieController::class, 'edit']);
    Route::delete('/destroy/{id}', [MovieController::class, 'destroy']);
});

Route::prefix('language')->group(function () {
    Route::get('/', [LanguageController::class, 'getAll']);
    Route::get('/{id}', [LanguageController::class, 'getSingle']);
    Route::post('/store', [LanguageController::class, 'store']);
    Route::put('/edit/[id}', [LanguageController::class, 'edit']);
    Route::delete('/destroy/{id}', [LanguageController::class, 'destroy']);
});

Route::middleware(['auth:sanctum', 'isAdmin'])->prefix('hall')->group(function () {
    Route::get('/', [HallController::class, 'getAll']);
    Route::get('/{id}', [HallController::class, 'getSingle']);
    Route::post('/store', [HallController::class, 'store']);
    Route::put('/edit/{id}', [HallController::class, 'edit']);
    Route::delete('/destroy/{id}', [HallController::class, 'destroy']);
});

Route::prefix('seat')->group(function () {
    Route::get('/', [SeatController::class, 'getAll']);
    Route::get('/{id}', [SeatController::class, 'getSingle']);
    Route::post('/store', [SeatController::class, 'store']);
    Route::put('/edit/{id}', [SeatController::class, 'edit']);
    Route::delete('/destroy/{id}', [SeatController::class, 'destroy']);
});

Route::middleware('already.authenticated')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::prefix('user')->group(function () {

    Route::middleware(['auth:sanctum', 'isSuperAdmin'])->group(function () {
        Route::get('/', [UserController::class, 'getAll']);
        Route::get('/{id}', [UserController::class, 'getSingle']);
        Route::post('/make-admin/{id}', [UserController::class, 'makeAdmin']);
        Route::post('/remove-admin/{id}', [UserController::class, 'removeAdmin']);
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::put('/edit/{id}', [UserController::class, 'edit']);
        Route::delete('/destroy/{id}', [UserController::class, 'destroy']);
    });
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
