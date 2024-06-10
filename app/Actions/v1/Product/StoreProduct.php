<?php

declare(strict_types=1);

namespace App\Actions\v1\Product;

use App\DTO\v1\Product\ProductDTO;
use App\Models\Product;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Response;
use Throwable;

final class StoreProduct
{
    public function handle(ProductDTO $dto): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            $code = IdGenerator::generate([
                'table' => 'products',
                'field' => 'code',
                'length' => 4,
                'prefix' => 'PC',
            ]);

            Product::create([
                'name' => $dto->getName(),
                'category_id' => $dto->getCategoryId(),
                'unit_id' => $dto->getUnitId(),
                'quantity' => $dto->getQuantity(),
                'quantity_alert' => $dto->getQuantityAlert(),
                'notes' => $dto->getNotes(),
                'buying_price' => $dto->getBuyingPrice(),
                'selling_price' => $dto->getSellingPrice(),
                'notes' => $dto->getNotes(),
                'code' => $code,
                'company_id' => auth()->user()->current_company,
            ]);

            return new ApiSuccessResponse(
                message: "Produit ajouté avec succès",
                code: Response::HTTP_CREATED,
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: Response::HTTP_NOT_FOUND,
            );
        }
    }
}
