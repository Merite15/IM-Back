<?php

declare(strict_types=1);

namespace App\DTO\v1\Export;

use Illuminate\Http\Request;

final class ExportDateDTO
{
    public function __construct(
        private readonly string $start_date,
        private readonly string $end_date,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->input('start_date'),
            $request->input('end_date'),
        );
    }

    public function toArray(): array
    {
        return [
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,,
        ];
    }
}
