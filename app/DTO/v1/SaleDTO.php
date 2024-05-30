<?php

declare(strict_types=1);

namespace App\DTO\v1;

use Illuminate\Http\Request;

final class SaleDTO
{
    public function __construct(
        private readonly string $date,
        private readonly string $receiptNo,
        private readonly int $totalAmount,
        private readonly string $paymentType,
        private readonly int $companyId,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            (string) $request->input('date'),
            (string) $request->input('receipt_no'),
            (int) $request->input('total_amount'),
            (string) $request->input('payment_type'),
            (int) $request->input('company_id'),
        );
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getReceiptNo(): string
    {
        return $this->receiptNo;
    }

    public function getTotalAmount(): int
    {
        return $this->totalAmount;
    }

    public function getPaymentType(): string
    {
        return $this->paymentType;
    }

    public function getCompanyId(): int
    {
        return $this->companyId;
    }
}
