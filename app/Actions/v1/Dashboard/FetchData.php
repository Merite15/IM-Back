<?php

declare(strict_types=1);

namespace App\Actions\v1\Dashboard;

use App\Models\Order;
use App\Models\Product;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Throwable;

final class FetchData
{
    public function handle(): ApiErrorResponse | ApiSuccessResponse
    {
        try {
            $data = [
                'total_paid' => Order::sum('pay'),
                'total_due' => Order::sum('due'),
                'complete_orders' => Order::where('order_status', 'complete')->get(),
                'products' => Product::orderBy('product_store')->take(5)->get(),
                'new_products' => Product::orderBy('buying_date')->take(2)->get(),
            ];

            return new ApiSuccessResponse(
                message: 'Données récupérées avec succès',
                data: $data,
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: $exception->getCode()
            );
        }
    }
}
