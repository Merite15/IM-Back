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
            $request->input('name'),
            $request->input('slug'),
            $request->input('short_code')
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
}
