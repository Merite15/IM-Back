<?php

declare(strict_types=1);

namespace App\DTO\v1;

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
            (string)$request->input('name'),
            (string)$request->input('address'),
            (string)$request->input('phone')
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

    public function getName(): string
    {
        return $this->name;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }
}
