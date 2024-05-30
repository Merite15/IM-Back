<?php

declare(strict_types=1);

namespace App\Actions\v1\User;

use App\DTO\v1\User\UserDTO;
use App\Models\User;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Throwable;

final class UpdateUser
{
    public function handle(string $id, UserDTO $dto): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            $user = User::query()->findOrFail($id);

            $user->update([
                'name' => $dto->getName(),
                'gender' => $dto->getGender(),
                'email' => $dto->getEmail(),
                'phone' => $dto->getPhone(),
            ]);

            if ($user->doesntHave('roles')) {
                $user->assignRole($dto->getRoleId());
            }

            $user->syncRoles($dto->getRoleId());

            return new ApiSuccessResponse(
                message: 'Element modifié avec succès',
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: Response::HTTP_NOT_FOUND,
            );
        }
    }
}
