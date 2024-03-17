<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchaseDetails>
 */
class PurchaseDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quantity' => fake()->numberBetween(1, 10),
            'unit_cost' => fake()->numberBetween(100, 1000),
            'total' => fake()->numberBetween(100, 10000),
            'product_id' => fake()->randomElement([1, 2, 3, 4, 5]),
            'purchase_id' => fake()->randomElement([1, 2, 3, 4, 5]),
            'company_id' => Company::all()->random()->id,
        ];
    }
}
