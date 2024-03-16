<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\TaxType;
use App\Models\Category;
use App\Models\Company;
use App\Models\Unit;
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
            'slug' => fake()->unique()->word(),
            'code' => fake()->unique()->word(),
            'category_id' => Category::all()->random()->id,
            'unit_id' => Unit::all()->random()->id,
            'quantity' => fake()->randomNumber(2),
            'image' => fake()->imageUrl(width: 640, height: 480),
            'buying_price' => fake()->randomNumber(2),
            'selling_price' => fake()->randomNumber(2),
            'quantity_alert' => fake()->randomElement([5, 10, 15]),
            'tax' => fake()->randomElement([5, 10, 15, 20, 25]),
            'tax_type' => fake()->randomElement(TaxType::values()),
            'company_id' => Company::all()->random()->id,
        ];
    }
}
