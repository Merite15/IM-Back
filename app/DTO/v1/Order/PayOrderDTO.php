<?php

declare(strict_types=1);

namespace App\DTO\v1\Order;

use Illuminate\Http\Request;

final class PayOrderDTO
{
    public function __construct(
        private readonly int $pay,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->input('pay')
        );
    }

    public function toArray(): array
    {
        return [
            'pay' => $this->pay,
        ];
    }
}
