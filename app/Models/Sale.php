<?php

namespace App\Models;

use App\Models\Scopes\CurrentCompanyScope;
use App\Models\Traits\HasOwnership;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use HasFactory, SoftDeletes, HasOwnership;

    protected $guarded = [];

    public function saleDetails(): HasMany
    {
        return $this->hasMany(SaleDetails::class);
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new CurrentCompanyScope());
    }
}
