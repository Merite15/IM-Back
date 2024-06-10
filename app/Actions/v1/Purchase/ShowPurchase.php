<?php

declare(strict_types=1);

namespace App\Actions\v1\Purchase;

use App\Http\Resources\v1\Purchase\PurchaseResource;
use App\Models\Purchase;
use App\Models\PurchaseDetails;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Throwable;

final class ShowPurchase
{
    public function handle(string $id): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            $purchase = new PurchaseResource(Purchase::query()->with('supplier', 'details')->findOrFail($id));

            $products = PurchaseDetails::where('purchase_id', $purchase->id)->get();

            return new ApiSuccessResponse(
                message: 'Achat récupéré avec succès',
                data: [
                    'purchase' => $purchase,
                    'products' => $products,
                ],
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: Response::HTTP_NOT_FOUND,
            );
        }
    }
}
