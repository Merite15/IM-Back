<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\PurchaseStatus;
use App\Models\Company;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Purchase>
 */
class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'supplier_id' => fake()->randomElement([1, 2, 3, 4, 5]),
            'date' => now(),
            'purchase_no' => fake()->randomElement([1, 2, 3, 4, 5]),
            'status' => fake()->randomElement(PurchaseStatus::values()),
            'total_amount' => fake()->randomNumber(2),
            'company_id' => Company::all()->random()->id,
        ];
    }
}
