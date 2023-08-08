<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Budget;
use Illuminate\Database\Seeder;

class BudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $budgets = Budget::factory()->for(Event::factory()->create())->count(10)->create();
    }
}
