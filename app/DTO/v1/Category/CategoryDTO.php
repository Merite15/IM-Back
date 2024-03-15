<?php

declare(strict_types=1);

namespace App\DTO\v1\Category;

use Illuminate\Http\Request;

final class CategoryDTO
{
    public function __construct(
        private readonly string $name,
        private readonly string $slug,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->input('name'),
            $request->input('slug')
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
        ];
    }
}
