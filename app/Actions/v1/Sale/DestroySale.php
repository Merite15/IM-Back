<?php

declare(strict_types=1);

namespace App\Actions\v1\Sale;

use App\Models\Sale;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Throwable;

final class DestroySale
{
    public function handle(string $id): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            Sale::query()->findOrFail($id)->delete();

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
