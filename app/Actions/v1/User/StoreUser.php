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
            $user = User::create([
                'name' => $dto->getName(),
                'gender' => $dto->getGender(),
                'email' => $dto->getEmail(),
                'password' => $dto->getPassword(),
                'phone' => $dto->getPhone(),
            ]);

            $user->assignRole($dto->getRoleId());

            return new ApiSuccessResponse(
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
