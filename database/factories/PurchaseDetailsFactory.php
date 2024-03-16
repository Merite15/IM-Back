<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Product;
use App\Models\Purchase;
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
            'purchase_id' => Purchase::all()->random()->id,
            'company_id' => Company::all()->random()->id,
            'product_id' =>  Product::all()->random()->id,
        ];
    }
}
