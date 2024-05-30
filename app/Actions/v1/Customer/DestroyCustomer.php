<?php

declare(strict_types=1);

namespace App\Actions\v1\Customer;

use App\Models\Customer;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Throwable;

final class DestroyCustomer
{
    public function handle(string $id): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            Customer::query()->findOrFail($id)->delete();

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
