<?php 

namespace App\Repositories\Interfaces;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function getAll(): Collection;

    public function find($id): User;

    public function findRole($name): Role;

    public function update($user, $data): User;

    public function delete($user): User;
}