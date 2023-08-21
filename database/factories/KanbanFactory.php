<?php

namespace Database\Factories;

use App\Models\Enums\KanbanAccessibility;
use App\Models\Enums\KanbanStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;

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
            'status' => KanbanStatus::randomValue(),
            'date_deadline' => fake()->date('Y-m-d'),
            'event_id' => fake()->numberBetween(1, Event::count())
        ];
    }
}
