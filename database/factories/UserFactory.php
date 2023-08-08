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
            'user_profile_img' => $this->faker->image('public/storage/', 200, 200, null, false),
            'Major' => $this->faker->word,
            'Faculty' => $this->faker->word,
            'Year' => $this->faker->numberBetween(1, 4), // Generates a random number between 1 and 4
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password123'),
            'remember_token' => Str::random(10),
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
