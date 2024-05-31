<?php

declare(strict_types=1);

namespace App\Actions\v1\User;

use App\DTO\v1\User\CreateUserDTO;
use App\Models\User;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Throwable;

final class StoreUser
{
    public function handle(CreateUserDTO $dto): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            $user = User::create([
                'name' => $dto->getName(),
                'email' => $dto->getEmail(),
                'password' => $dto->getPassword(),
            ]);

            $user->assignRole($dto->getRoleId());

            $user->companies()->sync($dto->getCompanies());

            return new ApiSuccessResponse(
                message: "Utilisateur ajouté avec succès",
                code: Response::HTTP_CREATED,
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: Response::HTTP_NOT_FOUND,
            );
        }
    }
}
