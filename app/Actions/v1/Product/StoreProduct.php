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

            $product_code = IdGenerator::generate([
                'table' => 'products',
                'field' => 'product_code',
                'length' => 4,
                'prefix' => 'PC'
            ]);

            $product = Product::create([
                'name' => $data['name'],
                'category_id' => $data['category_id'],
                'supplier_id' => $data['supplier_id'],
                'garage' => $data['garage'],
                'store' => $data['store'],
                'buying_date' => $data['buying_date'],
                'expire_date' => (int) $data['expire_date'],
                'buying_price' => $data['buying_price'],
                'selling_price' => $data['selling_price'],
                'product_code' => $product_code
            ]);

            if ($file = $data['product_image']) {
                $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
                $path = 'public/products/';

                $file->storeAs($path, $fileName);

                $product['image'] = $fileName;
            }

            return new ApiSuccessResponse(
                data: $product,
                message: "Employé ajouté avec succès",
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
