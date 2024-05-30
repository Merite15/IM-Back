<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\SupplierType;
use App\Enums\UserGender;
use App\Models\Scopes\CurrentCompanyScope;
use App\Models\Traits\HasOwnership;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory;
    use SoftDeletes, HasOwnership;

    protected $guarded = [];

    protected $casts = [
        'gender' => UserGender::class,
        'type' => SupplierType::class
    ];

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new CurrentCompanyScope());
    }
}
