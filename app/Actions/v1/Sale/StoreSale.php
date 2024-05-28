<?php

declare(strict_types=1);

namespace App\Actions\v1\Sale;

use App\DTO\v1\SaleDTO;
use App\Models\Sale;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Throwable;

final class StoreSale
{
    public function handle(SaleDTO $dto): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            Sale::create([
                'date' => $dto->getDate(),
                'receipt_no' => $dto->getReceiptNo(),
                'total_amount' => $dto->getTotalAmount(),
                'company_id' => auth()->user()->current_company,
            ]);

            return new ApiSuccessResponse(
                message: "fournisseur ajouté avec succès",
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
