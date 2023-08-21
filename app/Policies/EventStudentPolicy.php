<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\Student;
use App\Models\User;

class EventStudentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function attachApplicant(User $user, Student $student, Event $event) {
        return $event->isStudentEvent($user->student, 'HEAD') || $event->isStudentEvent($user->student, 'STAFF');
    }
    public function updateStatus(User $user, Event $event) {
        return $event->isStudentEvent($user->student, 'HEAD') || $event->isStudentEvent($user->student, 'STAFF');
    }
}