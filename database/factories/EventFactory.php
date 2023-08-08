<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Event::class;

    public function definition(): array
    {
        return [
            'event_name' => $this->faker->words(3, true),
            'event_date' => $this->faker->date('Y-m-d'),
            'event_location' => $this->faker->city,
            'event_expense_amount' => $this->faker->randomFloat(2, 10, 500),
            'event_participant_limit' => $this->faker->numberBetween(50, 500),
            'event_approval_status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'event_application_deadline' => $this->faker->date('Y-m-d'),
            'event_description' => $this->faker->realText(200),
            'event_thumbnail' => $this->faker->imageUrl(400, 300, 'events', true),
            'event_image' => $this->faker->image('public/storage/', 800, 600, null, false),
            'event_participant' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
