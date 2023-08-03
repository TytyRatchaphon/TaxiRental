<?php

namespace Database\Factories;

use App\Models\Enums\KanbanAccessibility;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kanban>
 */
class KanbanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->realTextBetween(5, 10),
            'detail' => fake()->realText(200),
            'status' => KanbanAccessibility::randomValue()
        ];
    }
}
