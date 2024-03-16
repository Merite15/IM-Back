<?php

declare(strict_types=1);

namespace App\Actions\v1\Product;

use App\Models\Product;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Throwable;

final class ExportProduct
{
    public function handle(): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            $products = Product::all()->sortByDesc('product_id');

            $product_array[] = array(
                'Product Name',
                'Category Id',
                'Supplier Id',
                'Product Code',
                'Product Garage',
                'Product Image',
                'Product Store',
                'Buying Date',
                'Expire Date',
                'Buying Price',
                'Selling Price',
            );

            foreach ($products as $product) {
                $product_array[] = array(
                    'Product Name' => $product->name,
                    'Category Id' => $product->category_id,
                    'Supplier Id' => $product->supplier_id,
                    'Product Code' => $product->code,
                    'Product Garage' => $product->garage,
                    'Product Image' => $product->image,
                    'Product Store' => $product->store,
                    'Buying Date' => $product->buying_date,
                    'Expire Date' => $product->expire_date,
                    'Buying Price' => $product->buying_price,
                    'Selling Price' => $product->selling_price,
                );
            }

            $this->exportExcel($product_array);
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: $exception->getCode()
            );
        }
    }
}
