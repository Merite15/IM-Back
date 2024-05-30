<?php

declare(strict_types=1);

namespace App\DTO\v1;

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
            (string) $request->input('start_date'),
            (string) $request->input('end_date'),
        );
    }

    public function toArray(): array
    {
        return [
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,,
        ];
    }

    public function getStartDate(): string
    {
        return $this->start_date;
    }

    public function getEndDate(): string
    {
        return $this->end_date;
    }
}
