<?php

declare(strict_types=1);

namespace App\DTO\v1\Supplier;

use App\Enums\SupplierType;
use App\Enums\UserGender;
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
        private readonly UserGender $gender,
        private readonly string $city,
    ) {
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            (string)$request->input('name'),
            (string)$request->input('email'),
            (string)$request->input('address'),
            (string)$request->input('phone'),
            (string)$request->input('shop_name'),
            SupplierType::from($request->input('type')),
            UserGender::from($request->input('gender')),
            (string)$request->input('city'),
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'phone' => $this->phone,
            'shop_name' => $this->shop_name,
            'gender' => $this->gender,
            'city' => $this->city,
            'type' => $this->type,
        ];
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

    public function getGender(): UserGender
    {
        return $this->gender;
    }

    public function getCity(): string
    {
        return $this->city;
    }
}
