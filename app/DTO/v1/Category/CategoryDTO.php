<?php

declare(strict_types=1);

namespace App\DTO\v1\Category;

use Illuminate\Http\Request;

final class CategoryDTO
{
    public function __construct(
        private readonly string $name,
    ) {
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            (string)$request->input('name'),
        );
    }

    public function getName(): string
    {
        return $this->name;
    }
}
