<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_firstname' => $this->faker->firstName,
            'user_lastname' => $this->faker->lastName,
            'username' => $this->faker->unique()->userName,
            'user_profile_img' => $this->faker->imageUrl(200, 200), // Generates a random image URL
            'major' => $this->faker->word,
            'faculty' => $this->faker->word,
            'year' => $this->faker->numberBetween(1, 4), // Generates a random number between 1 and 4
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password123'),
            'remember_token' => Str::random(10),
            'facebook' => fake()->name,
            'line' =>fake()->name(),
            'instagram' =>fake()->name
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
