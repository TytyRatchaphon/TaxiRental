<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed> 
     */
    public function definition(): array
    {

        return [
            'user_id' => User::factory()->create(['role' => 'USER'])->id,
            'major' => $this->faker->word,
            'year' => $this->faker->numberBetween(1, 4),
            'facebook' => fake()->name(),
            'line' => fake()->name(),
            'instagram' =>fake()->name(),
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
