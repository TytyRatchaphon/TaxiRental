<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserAdmin;

class UserAdminSeeder extends Seeder
{
    public function run()
    {
        UserAdmin::factory(1)->has(User::factory()->count(1))->create();
    }
}
