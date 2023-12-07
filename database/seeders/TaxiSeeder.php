<?php

namespace Database\Seeders;

use App\Models\Taxi;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaxiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Taxi::factory(15)->create();
    }
}