<?php

namespace Database\Seeders;

use App\Models\Kanban;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KanbanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kanban::factory(10)->create();
    }
}
