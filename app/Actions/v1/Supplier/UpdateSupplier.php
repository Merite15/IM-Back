<?php

declare(strict_types=1);

namespace App\Actions\v1\Supplier;

use App\DTO\v1\SupplierDTO;
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
            $supplier = Supplier::query()->findOrFail($id);

            $supplier->update([
                'type' => $dto->getType(),
                'name' => $dto->getName(),
                'email' => $dto->getEmail(),
                'address' => $dto->getAddress(),
                'phone' => $dto->getPhone(),
                'shop_name' => $dto->getShopName(),
                'city' => $dto->getCity(),
            ]);

            return new ApiSuccessResponse(message: 'Fournisseur modifié avec succès');
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: Response::HTTP_NOT_FOUND,
            );
        }
    }
}
