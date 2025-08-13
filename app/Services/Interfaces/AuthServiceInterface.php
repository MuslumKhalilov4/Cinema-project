<?php 

namespace App\Services\Interfaces;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

interface AuthServiceInterface{
    public function register(RegisterRequest $request): array;

    public function login(LoginRequest $request): array;

    public function logout(Request $request): void;
}