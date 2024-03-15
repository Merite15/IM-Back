<?php

declare(strict_types=1);

namespace App\Actions\v1\Customer;

use App\Http\Resources\v1\Customer\CustomerResource;
use App\Models\Customer;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Throwable;

final class ShowCustomer
{
    public function handle(string $id): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            return new ApiSuccessResponse(
                message: 'Client récupéré avec succès',
                data: new CustomerResource(Customer::query()->findOrFail($id)),
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: Response::HTTP_NOT_FOUND
            );
        }
    }
}
