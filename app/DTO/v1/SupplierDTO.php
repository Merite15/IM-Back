<?php

declare(strict_types=1);

namespace App\DTO\v1;

use App\Enums\SupplierType;
use Illuminate\Http\Request;

final class SupplierDTO
{
    public function __construct(
        private readonly string $name,
        private readonly string $email,
        private readonly string $address,
        private readonly string $phone,
        private readonly string $shop_name,
        private readonly SupplierType $type,
        private readonly string $city,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            (string) $request->input('name'),
            (string) $request->input('email'),
            (string) $request->input('address'),
            (string) $request->input('phone'),
            (string) $request->input('shop_name'),
            SupplierType::from($request->input('type')),
            (string) $request->input('city'),
        );
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getShopName(): string
    {
        return $this->shop_name;
    }

    public function getType(): SupplierType
    {
        return $this->type;
    }

    public function getCity(): string
    {
        return $this->city;
    }
}
