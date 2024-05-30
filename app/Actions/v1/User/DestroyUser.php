<?php

declare(strict_types=1);

namespace App\Actions\v1\User;

use App\Models\User;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Throwable;

final class DestroyUser
{
    public function handle(string $id): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            User::query()->findOrFail($id)->delete();

            return new ApiSuccessResponse(
                message: 'Element supprimé avec succès',
                code: Response::HTTP_OK,
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: $exception->getCode(),
            );
        }
    }
}
