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
            $data = $dto->toArray();

            $code = IdGenerator::generate([
                'table' => 'products',
                'field' => 'code',
                'length' => 4,
                'prefix' => 'PC'
            ]);

            $product = Product::create([
                'name' => $dto->getName(),
                'tax_type' => $dto->getTaxType(),
                'tax' => $dto->getTax(),
                'category_id' => $dto->getCategoryId(),
                'unit_id' => $dto->getUnitId(),
                'quantity' => $dto->getQuantity(),
                'notes' => $dto->getNotes(),
                'buying_price' => $dto->getBuyingPrice(),
                'selling_price' => $dto->getSellingPrice(),
                'code' => $code,
                'company_id' => auth()->user()->current_company,
            ]);

            if ($file = $data['image']) {
                $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
                $path = 'public/products/';

                $file->storeAs($path, $fileName);

                $product['image'] = $fileName;
            }

            return new ApiSuccessResponse(
                message: "Produit ajouté avec succès",
                code: Response::HTTP_CREATED
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: Response::HTTP_NOT_FOUND
            );
        }
    }
}
