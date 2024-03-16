<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\UserGender;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'email' => fake()->unique()->safeEmail,
            'phone' => fake()->unique()->phoneNumber,
            'address' => fake()->address,
            'shop_name' => fake()->optional()->company,
            'city' => fake()->city,
            'gender' => fake()->randomElement(UserGender::cases()),
            'company_id' => Company::all()->random()->id,
        ];
    }
}
