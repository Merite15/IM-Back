<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $guarded = [];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
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
        static::addGlobalScope('current_year', function (Builder $builder): void {
            $builder->whereYear('company_id', auth()->user()->current_company);
        });
    }
}
