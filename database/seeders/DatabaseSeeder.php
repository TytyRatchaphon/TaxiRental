<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CertificateShowCaseSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(EventSeeder::class);
        $this->call(KanbanSeeder::class);
        $this->call(OperatorSeeder::class);
    }
}
