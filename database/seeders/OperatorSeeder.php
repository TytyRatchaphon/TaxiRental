<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class OperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->email = 'operator1@example.com';
        $user->username = 'operator1';
        $user->user_firstname = 'firstname_op1';
        $user->user_lastname = 'lastname_op1';
        $user->password = Hash::make('password');
        $user->role = 'OPERATOR';
        $user->save();

        $user = new User();
        $user->email = 'operator2@example.com';
        $user->username = 'operator2';
        $user->user_firstname = 'firstname_op2';
        $user->user_lastname = 'lastname_op2';
        $user->password = Hash::make('password');
        $user->role = 'OPERATOR';
        $user->save();

        $user = new User();
        $user->email = 'operator3@example.com';
        $user->username = 'operator3';
        $user->user_firstname = 'firstname_op4';
        $user->user_lastname = 'lastname_op4';
        $user->password = Hash::make('password');
        $user->role = 'OPERATOR';
        $user->save();

        User::factory()->count(10)->create(['role' => 'OPERATOR']);
    }
}
