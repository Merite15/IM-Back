<?php

declare(strict_types=1);

namespace App\Actions\v1\Product;

use App\Models\Product;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Throwable;

final class ImportExcel
{
    public function handle(): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            $products = Product::query()->all()->sortBy('name');

            $product_array[] = [
                'Product Name',
                'Product Slug',
                'Category Id',
                'Unit Id',
                'Product Code',
                'Stock',
                "Stock Alert",
                'Buying Price',
                'Selling Price',
                'Product Image',
                "Note"
            ];

            foreach ($products as $product) {
                $product_array[] = [
                    'Product Name' => $product->name,
                    'Product Slug' => $product->slug,
                    'Category Id' => $product->category_id,
                    'Unit Id' => $product->unit_id,
                    'Product Code' => $product->code,
                    'Stock' => $product->quantity,
                    "Stock Alert" => $product->quantity_alert,
                    'Buying Price' => $product->buying_price,
                    'Selling Price' => $product->selling_price,
                    'Product Image' => $product->image,
                    "Note" => $product->note
                ];
            }

            Product::create($product_array);
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: $exception->getCode()
            );
        }
    }
}
