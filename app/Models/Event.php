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
    public function users() : BelongsToMany {
        return $this->belongsToMany(User::class);
    }
    public function kanbans() : HasMany {
        return $this->hasMany(Kanban::class);
    }
    public function applicants() : HasMany {
        return $this->hasMany(Applicant::class);
    }
    public function certificate() : HasOne {
        return $this->hasOne(Certificate::class);
    }
    public function student() {
        return $this->belongsTo(Student::class, 'student_id');
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
    public function isHeadEvent($user) {
        if ($this->student->user->id === $user->id) {
            return true;
        } else {
            return false;
        }
    }
    public function scopeByStatus($query, $status) {
        return $query->where('event_approval_status', $status);
    }
    public function scopeAfterDeadline($query) {
        return $query->where('event_application_deadline', '>', Carbon::now()->toDateString());
    }
}
