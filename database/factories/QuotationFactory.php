<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Models\Company;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quotation>
 */
class QuotationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => fake()->date(),
            'reference' => fake()->unique()->randomNumber(),
            'tax_percentage' => fake()->numberBetween(0, 20),
            'tax_amount' => fake()->numberBetween(0, 1000),
            'discount_percentage' => fake()->numberBetween(0, 50),
            'discount_amount' => fake()->numberBetween(0, 1000),
            'shipping_amount' => fake()->numberBetween(0, 100),
            'total_amount' => fake()->numberBetween(100, 5000),
            'note' => fake()->sentence(),
            'status' => fake()->randomElement(OrderStatus::cases()),
            'company_id' => Company::all()->random()->id,
            'customer_id' => fake()->randomElement([1, 2, 3, 4, 5]),
        ];
    }
}
