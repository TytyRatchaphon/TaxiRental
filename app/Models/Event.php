<?php

namespace App\Models;

use App\Models\Enums\EventStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events'; // Set the table name if it's different from the default

    protected $primaryKey = 'id'; // Set the primary key column name if it's different from the default

    protected $fillable = [
        'event_name',
        'event_date',
        'event_application_deadline',
        'event_location',
        'event_expense_amount',
        'event_applicants_limit',
        'event_staffs_limit',
        'event_description',
        'event_thumbnail',
        'event_image',
    ];

    public function kanbans() : HasMany {
        return $this->hasMany(Kanban::class);
    }
    public function certificate() : HasOne {
        return $this->hasOne(Certificate::class);
    }
    public function students() {
        return $this->belongsToMany(Student::class)->withPivot('role', 'status');
    }
    public function findByKanbanID($id) {
        return $this->kanbans()->find($id);
    }
    public function isOver() {
        if ($this->event_status === EventStatus::OVER) {
            return true;
        } else {
            return false;
        }
    }
    public function isFuture() {
        $currentDate = Carbon::now()->format('Y-m-d');
        $deadline = Carbon::parse($this->event_application_deadline);
        if ($deadline->isAfter($currentDate)) {
            return true;
        } else {
            $this->event_approval_status = "rejected";
            $this->save();
            return false;
        }
    }
    public function isStudentEvent($student, $role) {
        return $this->students()->byRoleEvent($role)->where('student_id', $student->id)->exists();
    }
    public function hasStudentInEvent($student) {
        return $this->students()->where('student_id', $student->id)->exists();
    }
    public function headEvent() {
        return $this->students()->byRoleEvent('HEAD')->first();
    }
    public function isStatus($status) {
        return $this->where('event_approval_status', $status)->exists();
    }
    public function getApplicant($status) {
        return $this->students()->byRoleEvent('APPLICANT')->byStatus($status)->get();
    }

    public function getStaff($status) {
        return $this->students()->byRoleEvent('STAFF')->byStatus($status)->get();
    }
    
    public function scopeByStatusEvent($query, $status) {
        return $query->where('event_approval_status', $status);
    }
    public function scopeByDeadline($query) {
        return $query->where('event_application_deadline', '>=', Carbon::now()->toDateString());
    }
    public function scopeByEndEvent($query) {
        return $query->where('event_date', '<=', Carbon::now()->toDateString());
    }
    public function scopeEndEvent($query) {
        return $query->where('event_date', '>', Carbon::now()->toDateString());
    }

    public function scopeForSerch($query, $input){
        return $query->where(function ($query) use ($input){
            $query->where('','LIKE',"{%input}");
        });
    }
}
