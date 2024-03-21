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
                'name' => $dto->getName(),
                'tax_type' => $dto->getTaxType(),
                'tax' => $dto->getTax(),
                'category_id' => $dto->getCategoryId(),
                'unit_id' => $dto->getUnitId(),
                'quantity' => $dto->getQuantity(),
                'notes' => $dto->getNotes(),
                'buying_price' => $dto->getBuyingPrice(),
                'selling_price' => $dto->getSellingPrice(),
            ]);

            if ($file = $data['product_image']) {
                $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

                $path = 'public/products/';

                $file->storeAs($path, $fileName);

                $product['image'] = $fileName;
            }

            return new ApiSuccessResponse(message: 'Element modifié avec succès');
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: Response::HTTP_NOT_FOUND
            );
        }
    }
}
