<?php

declare(strict_types=1);

namespace App\Actions\v1\Supplier;

use App\DTO\v1\Supplier\SupplierDTO;
use App\Models\Supplier;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Throwable;

final class UpdateSupplier
{
    public function handle(string $id, SupplierDTO $dto): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            $data = $dto->toArray();

            $supplier = Supplier::query()->findOrFail($id);

            $supplier->update([
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
                message: 'Element modifié avec succès',
                data: $supplier,
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: Response::HTTP_NOT_FOUND
            );
        }
    }
}
