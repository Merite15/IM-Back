<?php

declare(strict_types=1);

namespace App\Actions\v1\Product;

use App\DTO\v1\Product\ProductDTO;
use App\Models\Product;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Throwable;

final class UpdateProduct
{
    public function handle(string $id, ProductDTO $dto): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            $data = $dto->toArray();

            $product = Product::query()->findOrFail($id);

            $product->update([
                'name' => $data['name'],
                'tax_type' => $data['tax_type'],
                'tax' => $data['tax'],
                'category_id' => $data['category_id'],
                'unit_id' => $data['unit_id'],
                'quantity' => $data['quantity'],
                'notes' => $data['notes'],
                'buying_price' => $data['buying_price'],
                'selling_price' => $data['selling_price'],
            ]);

            if ($file = $data['product_image']) {
                $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

                $path = 'public/products/';

                $file->storeAs($path, $fileName);

                $product['image'] = $fileName;
            }

            return new ApiSuccessResponse(
                message: 'Element modifié avec succès',
                data: $product,
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: Response::HTTP_NOT_FOUND
            );
        }
    }
}
