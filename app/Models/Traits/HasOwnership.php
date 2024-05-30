<?php

declare(strict_types=1);

namespace App\Models\Traits;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasOwnership
{
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
