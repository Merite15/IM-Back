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
                'orders' => Order::query()->where('company_id', auth()->user->current_company)->count(),

                'products' => Product::query()->where('company_id', auth()->user->current_company)->count(),

                'purchases' => Purchase::query()->where('company_id', auth()->user->current_company)->count(),

                'todayPurchases' => Purchase::query()->where('company_id', auth()->user->current_company)->whereDate('date', today()->format('Y-m-d'))->count(),

                'todayProducts' => Product::query()->where('company_id', auth()->user->current_company)->whereDate('created_at', today()->format('Y-m-d'))->count(),

                'todayQuotations' => Quotation::query()->where('company_id', auth()->user->current_company)->whereDate('created_at', today()->format('Y-m-d'))->count(),

                'todayOrders' => Order::query()->where('company_id', auth()->user->current_company)->whereDate('created_at', today()->format('Y-m-d'))->count(),

                'categories' => Category::query()->where('company_id', auth()->user->current_company)->count(),

                'quotations' => Quotation::query()->where('company_id', auth()->user->current_company)->count()
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
