<?php

declare(strict_types=1);

namespace App\DTO\v1\User;

use App\Enums\UserGender;
use Illuminate\Http\Request;

final class UserDTO
{
    public function __construct(
        private readonly string $name,
        private readonly UserGender $gender,
        private readonly string $email,
        private readonly string $phone,
        private readonly string $password,
        private readonly int $role_id,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->input('gender'),
            $request->input('email'),
            $request->input('name'),
            $request->input('password'),
            $request->input('role_id'),
            $request->input('phone')
        );
    }

    public function toArray(): array
    {
        return [
            'gender' => $this->gender,
            'email' => $this->email,
            'name' => $this->name,
            'password' => $this->password,
            'phone' => $this->phone,
            'role_id' => $this->role_id,
        ];
    }
}
