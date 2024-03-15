<?php

declare(strict_types=1);

namespace App\DTO\v1\Product;

use Illuminate\Http\Request;

final class ImportProductDTO
{
    public function __construct(
        private readonly mixed $upload_file,
    ) {
    }

    public function toArray(): array
    {
        return [
            'upload_file' => $this->upload_file,
        ];
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->input('upload_file'),
        );
    }
}
