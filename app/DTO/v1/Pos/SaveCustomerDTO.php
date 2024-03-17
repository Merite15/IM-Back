<?php

declare(strict_types=1);

namespace App\DTO\v1\Pos;

use Illuminate\Http\Request;

final class SaveCustomerDTO
{
    public function __construct(
        private readonly int $customer_id,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->input('customer_id'),
        );
    }

    public function toArray(): array
    {
        return [
            'customer_id' => $this->customer_id,
        ];
    }
}
