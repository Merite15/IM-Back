<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PurchaseStatus;
use App\Models\Scopes\CurrentCompanyScope;
use App\Models\Traits\HasOwnership;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use HasFactory;
    use HasOwnership;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'status'     => PurchaseStatus::class,
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(PurchaseDetails::class);
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new CurrentCompanyScope());
    }
}
