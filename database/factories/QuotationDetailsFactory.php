<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuotationDetails>
 */
class QuotationDetailsFactory extends Factory
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
            'price' => fake()->numberBetween(100, 1000),
            'unit_price' => fake()->numberBetween(100, 500),
            'sub_total' => fake()->numberBetween(100, 5000),
            'product_discount_amount' => fake()->numberBetween(0, 100),
            'product_discount_type' => 'fixed',
            'product_tax_amount' => fake()->numberBetween(0, 100),
            'company_id' => Company::all()->random()->id,
            'quotation_id' => fake()->randomElement([1, 2, 3, 4, 5]),
            'product_id' => fake()->randomElement([1, 2, 3, 4, 5]),
        ];
    }
}
