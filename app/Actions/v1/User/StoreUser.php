<?php

declare(strict_types=1);

namespace App\Actions\v1\User;

use App\DTO\v1\User\UserDTO;
use App\Models\User;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Throwable;

final class StoreUser
{
    public function handle(UserDTO $dto): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            $data = $dto->toArray();

            $user = User::create([
                'name' => $data['name'],
                'gender' => $data['gender'],
                'email' => $data['email'],
                'password' => $data['password'],
                'phone' => $data['phone'],
            ]);

            $user->assignRole($data['role_id']);

            return new ApiSuccessResponse(
                data: $user,
                message: "Avance de salaire ajoutée avec succès",
                code: Response::HTTP_CREATED
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: Response::HTTP_NOT_FOUND
            );
        }
    }
}
