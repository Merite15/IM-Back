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
            (string) $request->input('name'),
            UserGender::from($request->input('gender')),
            (string) $request->input('email'),
            (string) $request->input('phone'),
            (string) $request->input('password'),
            (int) $request->input('role_id'),
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

    public function getName(): string
    {
        return $this->name;
    }

    public function getGender(): UserGender
    {
        return $this->gender;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRoleId(): int
    {
        return $this->role_id;
    }
}
