<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\SupplierType;
use App\Enums\UserGender;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'gender' => UserGender::class,
        'type' => SupplierType::class
    ];

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    /**
     * Get the company that owns the Category
     *
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    protected static function booted(): void
    {
        static::addGlobalScope('current_company', function (Builder $builder): void {
            if (auth()->check()) {
                $builder->where('company_id', auth()->user()->current_company);
            }
        });
    }
}
