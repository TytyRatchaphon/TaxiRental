<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserStudent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserStudent::factory(5)->has(User::factory()->count(5))->create();
    }
}
