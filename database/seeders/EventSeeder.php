<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\Event;
use App\Models\Kanban;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = Event::factory()->count(10)->has(Kanban::factory(10))->has(Certificate::factory())->create();
    }
}
