<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\Event;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CertificateShowCaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->email = 'student1@example.com';
        $user->username = 'user1';
        $user->user_firstname = 'firstname1';
        $user->user_lastname = 'lastname1';
        $user->password = Hash::make('password');
        $user->role = 'STUDENT';
        $user->save();

        $student = new Student();
        $student->major = 'major1';
        $student->faculty = 'faculty1';
        $student->year = 1;

        $event = Event::factory()->create();
        $event->students()->attach($student->id, ['role' => 'HEAD']);

        $user = new User();
        $user->email = 'student2@example.com';
        $user->username = 'user2';
        $user->user_firstname = 'firstname2';
        $user->user_lastname = 'lastname2';
        $user->password = Hash::make('password');
        $user->role = 'STUDENT';
        $user->save();

        $student = new Student();
        $student->major = 'major2';
        $student->faculty = 'faculty2';
        $student->year = 1;

        $user->student()->save($student);

        $event->students()->attach($student->id, ['role' => 'APPLICANT', 'status' => 'approved']);
        
        $certificate = new Certificate();

        $event->certificate()->save($certificate);
    }
}
