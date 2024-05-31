<?php

declare(strict_types=1);

namespace App\DTO\v1\User;

use Illuminate\Http\Request;

final class UpdateUserDTO
{
    public function __construct(
        private readonly string $name,
        private readonly string $email,
        private readonly array $companies,
        private readonly int $role_id,
    ) {
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            (string) $request->input('name'),
            (string) $request->input('email'),
            $request->input('companies'),
            (int) $request->input('role_id'),
        );
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCompanies(): array
    {
        return $this->companies;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getRoleId(): int
    {
        return $this->role_id;
    }
}
