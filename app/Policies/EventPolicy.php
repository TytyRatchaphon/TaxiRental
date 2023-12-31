<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class EventPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Event $event)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->isRole('ADMIN');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Event $event)
    {
        return $user->isRole('STUDENT') || $user->isRole('OPERATOR') || $event->headEvent()->user->id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Event $event)
    {
        return $user->isRole('ADMIN') || $event->headEvent()->user->id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Event $event)
    {
        return $user->isRole('ADMIN');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Event $event)
    {
        return $user->isRole('ADMIN');
    }
    
    public function requestJoin(User $user, Event $event) {
        return $user->isRole('USER');
    }

    public function showStatus(User $user, Event $event) {
        return $user->isRole('ADMIN');
    }

    public function viewKanban(User $user, Event $event) {
        return $user->isRole('STUDENT') 
            && $event->hasStudentInEvent($user->student) 
            && !$event->isStudentEvent($user->student, 'APPLICANT');
    }
    public function createKanban(User $user, Event $event) {
        return $user->isRole('STUDENT') 
            && $event->hasStudentInEvent($user->student) 
            && !$event->isStudentEvent($user->student, 'APPLICANT');
    }
    public function updateKanban(User $user, Event $event) {
        return $user->isRole('STUDENT') 
            && $event->hasStudentInEvent($user->student) 
            && !$event->isStudentEvent($user->student, 'APPLICANT');
    }
    public function deleteKanban(User $user, Event $event) {
        return $user->isRole('STUDENT') 
            && $event->hasStudentInEvent($user->student) 
            && !$event->isStudentEvent($user->student, 'APPLICANT');
    }

    public function showCertificate(User $user, Event $event) {
        return $user->isRole('STUDENT')
            && $event->event_approval_status === "approved"
            && $event->hasStudentInEvent($user->student)
            && $event->getApplicant('approved')->find($user->student)->id === $user->student->id;
    }
 }
