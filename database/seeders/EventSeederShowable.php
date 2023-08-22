<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\Event;
use App\Models\Kanban;
use Illuminate\Database\Seeder;

class EventSeederShowable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = Event::factory()->count(10)->withHeadUser()->has(Kanban::factory(10))->has(Certificate::factory())->create();
    }
}
