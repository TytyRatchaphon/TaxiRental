<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->email = 'student3@example.com';
        $user->username = 'user3';
        $user->user_firstname = 'firstname3';
        $user->user_lastname = 'lastname3';
        $user->password = Hash::make('password');
        $user->role = 'STUDENT';
        $user->save();

        $student = new Student();
        $student->major = 'major';
        $student->faculty = 'faculty';
        $student->year = 4;
        $user->student()->save($student);

        $user = new User();
        $user->email = 'student4@example.com';
        $user->username = 'student4';
        $user->user_firstname = 'firstname4';
        $user->user_lastname = 'lastname4';
        $user->password = Hash::make('password');
        $user->role = 'STUDENT';
        $user->save();

        $student = new Student();
        $student->major = 'major';
        $student->faculty = 'faculty';
        $student->year = 2;
        $user->student()->save($student);

        $user = new User();
        $user->email = 'student5@example.com';
        $user->username = 'student5';
        $user->user_firstname = 'firstname5';
        $user->user_lastname = 'lastname5';
        $user->password = Hash::make('password');
        $user->role = 'STUDENT';
        $user->save();

        $student = new Student();
        $student->major = 'major';
        $student->faculty = 'faculty';
        $student->year = 4;
        $user->student()->save($student);

        Student::factory(15)->has(User::factory(15))->create();
    }
}
