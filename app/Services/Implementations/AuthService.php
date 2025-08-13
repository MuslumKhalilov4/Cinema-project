<?php

namespace App\Services\Implementations;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }
    public function register(RegisterRequest $request): array
    {
        DB::beginTransaction();
        try {

            $new_user = $this->authRepository->create($request);

            DB::commit();

            $token = $new_user->createToken('default')->plainTextToken;

            return [
                'user' => $new_user,
                'token' => $token
            ];

        } catch (\Throwable $e) {
            DB::rollBack();

            throw $e;
        }
    }

    public function login(LoginRequest $request): array
    {
        $user = User::where('email', $request->email);

        if(!$user || !Hash::check($request->password, $user->password)){
            throw new AuthenticationException('Email or Password is incorrect!');
        }

        $token = $user->createToken('default');

        return [
            'user' => $user,
            'token' => $token 
        ];

    }

    public function logout(Request $request): void
    {
        DB::beginTransaction();
        try {
            $this->authRepository->deleteToken($request);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();

            throw $e;
        }
        
    }
}
