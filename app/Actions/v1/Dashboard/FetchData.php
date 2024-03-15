<?php

declare(strict_types=1);

namespace App\Actions\v1\Dashboard;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Quotation;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Throwable;

final class FetchData
{
    public function handle(): ApiErrorResponse | ApiSuccessResponse
    {
        try {
            $data = [
                'orders' => Order::query()->all()->count(),
                'products' => Product::query()->all()->count(),
                'purchases' => Purchase::query()->all()->count(),
                'todayPurchases' => Purchase::query()->whereDate('date', today()->format('Y-m-d'))->count(),
                'todayProducts' => Product::query()->whereDate('created_at', today()->format('Y-m-d'))->count(),
                'todayQuotations' => Quotation::query()->whereDate('created_at', today()->format('Y-m-d'))->count(),
                'todayOrders' => Order::query()->whereDate('created_at', today()->format('Y-m-d'))->count(),
                'categories' => Category::query()->all()->count(),
                'quotations' => Quotation::query()->all()->count()
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
