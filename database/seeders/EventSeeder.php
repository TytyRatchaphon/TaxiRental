<?php

namespace Database\Seeders;

use App\Models\Budget;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = Event::factory()->has(User::factory()->count(10))->has(Budget::factory()->count(20))->count(5)->create();
    }
}
