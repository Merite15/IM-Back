<?php

declare(strict_types=1);

namespace App\Actions\v1\Product;

use App\Http\Resources\v1\Product\ProductResource;
use App\Models\Product;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Throwable;

final class ShowProduct
{
    public function handle(string $id): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            $generator = new BarcodeGeneratorHTML();

            $product = new ProductResource(Product::query()->findOrFail($id));

            $barcode = $generator->getBarcode($product->code, $generator::TYPE_CODE_128);

            $data = [
                'product' => $product,
                'barcode' => $barcode,
            ];

            return new ApiSuccessResponse(
                message: 'Element récupéré avec succès',
                data: $data,
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: Response::HTTP_NOT_FOUND,
            );
        }
    }
}
