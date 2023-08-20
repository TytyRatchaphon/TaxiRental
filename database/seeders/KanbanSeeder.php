<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Kanban;
use Illuminate\Database\Seeder;

class KanbanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kanbans = Kanban::factory()->count(10)->create();
    }
}
