<?php

declare(strict_types=1);

namespace App\DTO\v1\Auth;

use Illuminate\Http\Request;

final class LoginDTO
{
    public function __construct(
        private readonly string $email,
        private readonly string $password,
    ) {
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            (string)$request->input('email'),
            (string)$request->input('password'),
        );
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
