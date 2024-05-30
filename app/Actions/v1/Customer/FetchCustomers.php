<?php

declare(strict_types=1);

namespace App\Actions\v1\Customer;

use App\Http\Resources\v1\Customer\CustomerCollection;
use App\Models\Customer;
use App\Responses\ApiErrorResponse;
use App\Responses\v1\Customer\CustomerCollectionResponse;
use Throwable;

final class FetchCustomers
{
    public function handle(): ApiErrorResponse | CustomerCollectionResponse
    {
        try {
            return new CustomerCollectionResponse(
                customerCollection: new CustomerCollection(
                    resource: Customer::query()->latest()->get(),
                ),
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
            );
        }
    }
}
