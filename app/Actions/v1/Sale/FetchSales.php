<?php

declare(strict_types=1);

namespace App\Actions\v1\Sale;

use App\Http\Resources\v1\Sale\SaleCollection;
use App\Models\Sale;
use App\Responses\ApiErrorResponse;
use App\Responses\v1\Sale\SaleCollectionResponse;
use Throwable;

final class FetchSales
{
    public function handle(): ApiErrorResponse | SaleCollectionResponse
    {
        try {
            return new SaleCollectionResponse(
                saleCollection: new SaleCollection(
                    resource: Sale::query()->latest()->get(),
                ),
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
            );
        }
    }
}
