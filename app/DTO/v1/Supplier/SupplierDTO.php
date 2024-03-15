<?php

declare(strict_types=1);

namespace App\DTO\v1\Supplier;

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
        private readonly string $type,
        private readonly UserGender $gender,
        private readonly string $city,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->input('name'),
            $request->input('email'),
            $request->input('address'),
            $request->input('phone'),
            $request->input('shop_name'),
            $request->input('gender'),
            $request->input('city'),
            $request->input('type')
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
}
