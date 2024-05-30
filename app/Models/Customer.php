<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\UserGender;
use App\Models\Scopes\CurrentCompanyScope;
use App\Models\Traits\HasOwnership;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes, HasOwnership;

    protected $guarded = [];

    protected $casts = [
        'gender' => UserGender::class,
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function quotations(): HasMany
    {
        return $this->HasMany(Quotation::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new CurrentCompanyScope());
    }
}
