<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1;

use App\Actions\v1\User\DestroyUser;
use App\Actions\v1\User\FetchUsers;
use App\Actions\v1\User\ShowUser;
use App\Actions\v1\User\StoreUser;
use App\Actions\v1\User\UpdateUser;
use App\DTO\v1\User\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\User\StoreUserRequest;
use App\Http\Requests\v1\User\UpdateUserRequest;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use App\Responses\v1\User\UserCollectionResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FetchUsers $action): UserCollectionResponse | ApiErrorResponse
    {
        return $action->handle();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request, StoreUser $action)
    {
        return $action->handle(UserDTO::fromRequest($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, ShowUser $action): ApiSuccessResponse | ApiErrorResponse
    {
        return $action->handle($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id, UpdateUser $action)
    {
        return $action->handle($id, UserDTO::fromRequest($request));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, DestroyUser $action)
    {
        return $action->handle($id);
    }
}
