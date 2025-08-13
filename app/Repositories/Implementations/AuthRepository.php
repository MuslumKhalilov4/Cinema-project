<?php 

namespace App\Repositories\Implementations;

use App\Models\User;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface{
    public function create($request): User
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 1,
            'age' => $request->age
        ]);

        return $user;
    }

    public function deleteToken($request): void
    {
        $user = $request->user();

        $user->currentAccessToken()->delete();
    }
}