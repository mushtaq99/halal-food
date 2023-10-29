<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //this->faker->sentence,
        return [
            'user_id'=> User::factory(),
            'name'=> fake()->country(),
            'code'=> fake()->countryCode(),
        ];
    }
}
