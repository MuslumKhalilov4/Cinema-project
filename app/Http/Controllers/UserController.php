<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\JsonResponse;


class UserController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function getAll(): JsonResponse
    {
        $users = $this->userService->getAllUsers();

        return Helper::successResponse('Users retrieved successfully!', UserResource::collection($users), 200);
    }

    public function getSingle($id): JsonResponse
    {
        $user = $this->userService->getUser($id);

        return Helper::successResponse('User retrieved successfully!', new UserResource($user), 200);
    }

    public function makeAdmin($id): JsonResponse
    {
            $user = $this->userService->makeAdmin($id);

           return Helper::successResponse("User's role is admin now!", new UserResource($user), 200);
    }

    public function removeAdmin($id): JsonResponse
    {
        $user = $this->userService->removeAdmin($id);

        return Helper::successResponse('User is no longer admin!', new UserResource($user), 200);
    }

    public function edit($id, UserUpdateRequest $request): JsonResponse
    {
        $user = $this->userService->updateUser($id, $request);

        return Helper::successResponse('Account updated successfully!', new UserResource($user), 200);
    }

    public function destroy($id): JsonResponse
    {
        $user = $this->userService->deleteUser($id);

        return Helper::successResponse('Account deleted successfully!', new UserResource($user), 200);
    }
}
