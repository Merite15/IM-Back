<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\PaymentType;
use App\Models\Scopes\CurrentCompanyScope;
use App\Models\Traits\HasOwnership;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use HasOwnership;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'order_date'    => 'date',
        'order_status'  => OrderStatus::class,
        'payment_type'  => PaymentType::class,
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(OrderDetails::class);
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new CurrentCompanyScope());
    }
}
