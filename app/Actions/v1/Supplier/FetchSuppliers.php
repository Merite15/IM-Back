<?php

declare(strict_types=1);

namespace App\Actions\v1\Supplier;

use App\Http\Resources\v1\Supplier\SupplierCollection;
use App\Models\Supplier;
use App\Responses\ApiErrorResponse;
use App\Responses\v1\Supplier\SupplierCollectionResponse;
use Throwable;

final class FetchSuppliers
{
    public function handle(): ApiErrorResponse | SupplierCollectionResponse
    {
        try {
            return new SupplierCollectionResponse(
                supplierCollection: new SupplierCollection(
                    resource: Supplier::query()->latest()->get()
                ),
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception
            );
        }
    }
}
