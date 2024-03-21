<?php

declare(strict_types=1);

namespace App\DTO\v1\Unit;

use Illuminate\Http\Request;

final class UnitDTO
{
    public function __construct(
        private readonly string $name,
        private readonly string $slug,
        private readonly string $short_code,
    ) {
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            (string)$request->input('name'),
            (string)$request->input('slug'),
            (string)$request->input('short_code')
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'short_code' => $this->short_code,
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getShortCode(): string
    {
        return $this->short_code;
    }
}
