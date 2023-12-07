<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Carbon\Carbon;

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
        $deadline = Carbon::now()->addWeek();;
        return [
            'car_license' => $this->faker->firstName,
            'car_status' => $this->faker->randomElement(['occupied', 'available', 'maintain']),
            'registration_no' => $this->faker->numerify('##########'),
            'car_color' => $this->faker->colorName,
            'car_year' => $this->faker->dateTimeThisYear,

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
            $headEvent = User::where('role', 'STUDENT')->inRandomOrder()->first();
            if ($headEvent) {
                // Debug statements
                echo "Attaching user with ID: {$headEvent->id} as HEAD to event with ID: {$event->id}\n";
                $event->students()->attach($headEvent, ['role' => 'HEAD', 'status' => 'pending']);
            } else {
                echo "No user with role STUDENT found.\n";
            }
            $applicants = User::where('role', 'STUDENT')->where('id', '!=', $headEvent->id)->inRandomOrder()->take(5)->get();
            foreach ($applicants as $applicant) {
                // Debug statements
                echo "Adding student with ID: {$applicant->id} as applicant to event with ID: {$event->id}\n";
                $event->students()->attach($applicant, ['role' => 'APPLICANT', 'status' => fake()->randomElement(['pending', 'approved'])]);
            }

            if ($applicants->isEmpty()) {
                echo "No students with role STUDENT found for applicants.\n";
            }
        });
    }
}
