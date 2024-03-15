<?php

declare(strict_types=1);

namespace App\Actions\v1\Supplier;

use App\DTO\v1\Supplier\SupplierDTO;
use App\Models\Supplier;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Throwable;

final class StoreSupplier
{
    public function handle(SupplierDTO $dto): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            $data = $dto->toArray();

            $supplier = Supplier::create([
                'type' => $data['type'],
                'name' => $data['name'],
                'email' => $data['email'],
                'address' => $data['address'],
                'phone' => $data['phone'],
                'shop_name' => $data['shop_name'],
                'gender' => $data['gender'],
                'city' => $data['city'],
            ]);

            return new ApiSuccessResponse(
                data: $supplier,
                message: "Avance de salaire ajoutée avec succès",
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
