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
            $data = $dto->toArray();

            $user = User::query()->findOrFail($id);

            $user->update([
                'name' => $data['name'],
                'gender' => $data['gender'],
                'email' => $data['email'],
                'phone' => $data['phone'],
            ]);

            if ($user->doesntHave('roles')) {
                $user->assignRole($data['role_id']);
            }

            $user->syncRoles($data['role_id']);

            return new ApiSuccessResponse(
                message: 'Element modifié avec succès',
                data: $user,
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: Response::HTTP_NOT_FOUND
            );
        }
    }
}
