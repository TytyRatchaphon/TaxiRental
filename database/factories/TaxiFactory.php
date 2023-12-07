<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class TaxiFactory extends Factory{
      /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'car_license' => $this->faker->firstName,
            'car_status' => $this->faker->randomElement(['occupied', 'available', 'maintain']),
            'registration_no' => $this->faker->numerify('##########'),
            'car_color' => $this->faker->colorName,
            'car_year' => $this->faker->dateTimeThisYear,

        ];
    }

}