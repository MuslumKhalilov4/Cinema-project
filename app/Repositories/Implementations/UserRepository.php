<?php 

namespace App\Repositories\Implementations;

use App\Models\Role;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function getAll(): Collection
    {
        $users = User::all();

        return $users;
    }

    public function find($id): User
    {
        $user = User::findOrFail($id);

        return $user;
    }

    public function findRole($name): Role
    {
        $role = Role::where('name', $name)->first();

        return $role;
    }

    public function update($user, $data): User
    {
        $user->update($data);

        return $user;
    }

    public function delete($user): User
    {
        $user->delete();

        return $user;
    }
}