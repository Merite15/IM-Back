<?php

declare(strict_types=1);

namespace App\Actions\v1\Order;

use App\Http\Resources\v1\Order\OrderCollection;
use App\Models\Order;
use App\Responses\ApiErrorResponse;
use App\Responses\v1\Order\OrderCollectionResponse;
use Throwable;

final class FetchDueOrders
{
    public function handle(): ApiErrorResponse | OrderCollectionResponse
    {
        try {
            return new OrderCollectionResponse(
                orderCollection: new OrderCollection(
                    resource: Order::query()
                        ->where('due', '>', '0')
                        ->with('customer')
                        ->latest()
                        ->get()
                ),
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception
            );
        }
    }
}
