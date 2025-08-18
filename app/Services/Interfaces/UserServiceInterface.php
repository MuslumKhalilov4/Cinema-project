<?php 

namespace App\Services\Interfaces;

use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserServiceInterface
{
    public function getAllUsers(): Collection;

    public function getUser($id): User;

    public function makeAdmin($id): User;

    public function removeAdmin($id): User;

    public function updateUser($id, UserUpdateRequest $request): User;

    public function deleteUser($id): User;
}