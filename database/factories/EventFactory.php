<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

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
            'event_application_deadline' => $this->faker->date('Y-m-d'),
            'event_location' => $this->faker->city,
            'event_expense_amount' => $this->faker->randomFloat(2, 10, 500),
            'event_applicants_limit' => $this->faker->numberBetween(50, 500),
            'event_approval_status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'event_description' => $this->faker->realText(200),
            'event_staffs_limit' => $this->faker->numberBetween(0, 20),
        ];
    }

    /**
     * Define the "withHeadUser" state to attach a user with the "HEAD" role to the event.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withHeadUser()
    {
        return $this->afterCreating(function (Event $event) {
            $user = User::where('role', 'STUDENT')->inRandomOrder()->first();
            if ($user) {
                // Debug statements
                echo "Attaching user with ID: {$user->id} as HEAD to event with ID: {$event->id}\n";
                $event->students()->attach($user, ['role' => 'HEAD', 'status' => 'approved']);
            } else {
                echo "No user with role STUDENT found.\n";
            }
        });
    }
}
