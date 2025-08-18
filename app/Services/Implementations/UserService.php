<?php

namespace App\Services\Implementations;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;
use App\Http\Requests\User\UserUpdateRequest;
use Illuminate\Auth\Access\AuthorizationException;
use RuntimeException;

class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers(): Collection
    {
        try {
            $users = $this->userRepository->getAll();

            if ($users->isEmpty()) {
                throw new ModelNotFoundException();
            }

            return $users;
        } catch (\Throwable $e) {
            Helper::logException($e);

            throw $e;
        }
    }

    public function getUser($id): User
    {
        try {
            $user = $this->userRepository->find($id);

            if (!$user) {
                throw new ModelNotFoundException();
            }

            return $user;
        } catch (\Throwable $e) {
            Helper::logException($e);

            throw $e;
        }
    }

    public function makeAdmin($id): User
    {
        DB::beginTransaction();

        try {
            $user = $this->userRepository->find($id);

            if (!$user) {
                throw new ModelNotFoundException();
            }

            $role = $this->userRepository->findRole('admin');

            $data = ['role_id' => $role->id];

            $updated = $this->userRepository->update($user, $data);

            DB::commit();

            return $updated;
        } catch (\Throwable $e) {
            DB::rollBack();

            Helper::logException($e);

            throw $e;
        }
    }

    public function removeAdmin($id): User
    {
        Db::beginTransaction();

        try {
            $user = $this->userRepository->find($id);

            if (!$user) {
                throw new ModelNotFoundException();
            }

            $role = $this->userRepository->findRole('user');

            $data = ['role_id' => $role->id];

            $updated = $this->userRepository->update($user, $data);

            DB::commit();

            return $updated;
        } catch (\Throwable $e) {
            DB::rollBack();

            Helper::logException($e);

            throw $e;
        }
    }

    public function updateUser($id, UserUpdateRequest $request): User
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            $user = $this->userRepository->find($id);

            if (auth()->user()->id != $user->id) {
                throw new AuthorizationException('You are not allowed to update this profile!');
            }

            if (!$user) {
                throw new ModelNotFoundException();
            }

            $updated = $this->userRepository->update($user, $data);

            DB::commit();

            return $updated;
        } catch (\Throwable $e) {
            DB::rollBack();

            Helper::logException($e);

            throw $e;
        }
    }

    public function deleteUser($id): User
    {
        try {
            $user = $this->userRepository->find($id);

            if (auth()->user()->id != $user->id) {
                throw new AuthorizationException('You are not allowed to delete this profile!');
            }

            if (!$user) {
                throw new ModelNotFoundException();
            }

            $deleted = $this->userRepository->delete($user);

            return $deleted;
        } catch (\Throwable $e) {
            Helper::logException($e);

            throw $e;
        }
    }
}
