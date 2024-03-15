<?php

declare(strict_types=1);

namespace App\DTO\v1\Company;

use Illuminate\Http\Request;

final class CompanyDTO
{
    public function __construct(
        private readonly string $name,
        private readonly string $address,
        private readonly string $phone,
    ) {
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->input('name'),
            $request->input('address'),
            $request->input('phone')
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
        ];
    }
}
