<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'code' => fake()->unique()->word(),
            'category_id' => fake()->randomElement([1, 2, 3, 4, 5]),
            'unit_id' => fake()->randomElement([1, 2, 3, 4, 5]),
            'quantity' => fake()->randomNumber(2),
            'image' => fake()->imageUrl(width: 640, height: 480),
            'buying_price' => fake()->randomNumber(2),
            'selling_price' => fake()->randomNumber(2),
            'quantity_alert' => fake()->randomElement([5, 10, 15]),
            'company_id' => Company::all()->random()->id,
        ];
    }
}
