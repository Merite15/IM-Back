<?php

declare(strict_types=1);

namespace App\Actions\v1\Sale;

use App\DTO\v1\SaleDTO;
use App\Models\Sale;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Throwable;

final class UpdateSale
{
    public function handle(string $id, SaleDTO $dto): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            $sale = Sale::query()->findOrFail($id);

            $sale->update([
                'date' => $dto->getDate(),
                'receipt_no' => $dto->getReceiptNo(),
                'total_amount' => $dto->getTotalAmount(),
            ]);

            return new ApiSuccessResponse(message: 'Element modifié avec succès');
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: Response::HTTP_NOT_FOUND
            );
        }
    }
}
