<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Country>
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
        $name = $this->faker->name;
        $code = strtoupper(substr($name,0,2));

        return [
            'name' => $name,
            'code' => $code,
            'stake' => $this->faker->randomNumber(2),
        ];
    }
}
