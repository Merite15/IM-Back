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
            $product = Product::query()->findOrFail($id);

            $product->update([
                'name' => $dto->getName(),
                'category_id' => $dto->getCategoryId(),
                'unit_id' => $dto->getUnitId(),
                'quantity' => $dto->getQuantity(),
                'quantity_alert' => $dto->getQuantityAlert(),
                'notes' => $dto->getNotes(),
                'buying_price' => $dto->getBuyingPrice(),
                'selling_price' => $dto->getSellingPrice(),
                'notes' => $dto->getNotes(),
            ]);

            return new ApiSuccessResponse(message: 'Element modifié avec succès');
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: Response::HTTP_NOT_FOUND,
            );
        }
    }
}
