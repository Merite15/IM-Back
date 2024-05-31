<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SaleDetails>
 */
class SaleDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $unitPrice = $this->faker->numberBetween(100, 1000);
        $quantity = $this->faker->numberBetween(1, 10);
        $total = $unitPrice * $quantity;

        return [
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'total' => $total,
            'sale_id' => Sale::all()->random()->id,
            'product_id' => fake()->randomElement([1, 2, 3, 4, 5]),
            'company_id' => fake()->randomElement([1, 2, 3, 4, 5]),
        ];
    }
}
