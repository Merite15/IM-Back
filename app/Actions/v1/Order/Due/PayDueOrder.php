<?php

declare(strict_types=1);

namespace App\Actions\v1\Order;

use App\DTO\v1\Order\PayOrderDTO;
use App\Enums\OrderStatus;
use App\Mail\StockAlert;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Throwable;

final class PayDueOrder
{
    public function handle(string $id, PayOrderDTO $dto): ApiErrorResponse | ApiSuccessResponse
    {
        try {
            $data = $dto->toArray();

            $order = Order::query()->findOrFail($id);

            $paidDue = $order->due - $data['pay'];

            $paidPay = $order->pay + $data['pay'];

            $order->update([
                'due' => $paidDue,
                'pay' => $paidPay
            ]);

            if ($paidDue === 0) {
                $order->update([
                    'status' => OrderStatus::Complete
                ]);

                $products = OrderDetails::where('order_id', $order->id)->get();

                $stockAlertProducts = [];

                foreach ($products as $product) {
                    $productEntity = Product::where('id', $product->product_id)->first();

                    $newQty = $productEntity->quantity - $product->quantity;

                    if ($newQty < $productEntity->quantity_alert) {
                        $stockAlertProducts[] = $productEntity;
                    }

                    $productEntity->update(['quantity' => $newQty]);
                }

                if (count($stockAlertProducts) > 0) {
                    Mail::to(auth()->user()->hasRole('admin'))->send(new StockAlert($stockAlertProducts));
                }
            }

            return new ApiSuccessResponse(
                message: 'Commande payée avec succès',
                code: Response::HTTP_ACCEPTED
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception
            );
        }
    }
}
