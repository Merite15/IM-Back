<?php

declare(strict_types=1);

namespace App\Actions\v1\Purchase;

use App\Enums\PurchaseStatus;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetails;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Throwable;

final class ApprovedPurchase
{
    public function handle(string $id): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            DB::beginTransaction();

            $purchase = Purchase::query()->findOrFail($id);

            $purchase->update([
                'status' => PurchaseStatus::Approved,
            ]);

            $products = PurchaseDetails::query()->where('purchase_id', $purchase->id)->get();

            foreach ($products as $product) {
                Product::query()->where('id', $product->product_id)
                    ->update(['quantity' => DB::raw('quantity+' . $product->quantity)]);
            }

            DB::commit();

            return new ApiSuccessResponse(
                message: 'Achat approuvé avec succès',
                code: Response::HTTP_OK,
            );
        } catch (Throwable $exception) {
            DB::rollBack();

            return new ApiErrorResponse(
                exception: $exception,
                code: $exception->getCode(),
            );
        }
    }
}
