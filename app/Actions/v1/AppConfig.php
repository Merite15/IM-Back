<?php

declare(strict_types=1);

namespace App\Actions\v1;

use App\Enums\PaymentType;
use App\Enums\PurchaseStatus;
use App\Enums\SupplierType;
use App\Enums\UserGender;
use App\Responses\ApiSuccessResponse;

final class AppConfig
{
    public function handle(): ApiSuccessResponse
    {
        $data = [
            'payment_type' => PaymentType::values(),
            'purchase_status' => PurchaseStatus::values(),
            'supplier_type' => SupplierType::values(),
            'user_gender' => UserGender::values(),
        ];

        return new ApiSuccessResponse(
            message: 'Données récupérées avec succès',
            data: $data,
        );
    }
}
