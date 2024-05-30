<?php

declare(strict_types=1);

namespace App\Actions\v1\Purchase;

use App\Enums\PurchaseStatus;
use App\Http\Resources\v1\Purchase\PurchaseCollection;
use App\Models\Purchase;
use App\Responses\ApiErrorResponse;
use App\Responses\v1\Purchase\PurchaseCollectionResponse;
use Throwable;

final class FetchApprovedPurchases
{
    public function handle(): ApiErrorResponse | PurchaseCollectionResponse
    {
        try {
            return new PurchaseCollectionResponse(
                purchaseCollection: new PurchaseCollection(
                    resource: Purchase::query()
                        ->with('supplier')
                        ->where('status', PurchaseStatus::APPROVED)
                        ->get(),
                ),
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
            );
        }
    }
}
