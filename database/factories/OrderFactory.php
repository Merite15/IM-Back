<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Enums\PaymentType;
use App\Models\Company;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
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
            'status' => fake()->randomElement(OrderStatus::values()),
            'total_products' => fake()->numberBetween(1, 10),
            'sub_total' => fake()->numberBetween(100, 1000),
            'vat' => fake()->numberBetween(10, 100),
            'total' => fake()->numberBetween(100, 1000),
            'invoice_no' => Str::random(10),
            'payment_type' => fake()->randomElement(PaymentType::cases()),
            'pay' => fake()->numberBetween(0, 500),
            'due' => fake()->numberBetween(0, 500),
            'customer_id' => fake()->randomElement([1, 2, 3, 4, 5]),
            'company_id' => Company::all()->random()->id,
        ];
    }
}
