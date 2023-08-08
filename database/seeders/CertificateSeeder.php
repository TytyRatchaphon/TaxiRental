<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $certificates = Certificate::factory()->for(User::factory())->for(Event::factory())->count(10)->create();
    }
}
