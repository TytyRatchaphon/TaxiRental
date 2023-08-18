<?php

namespace App\Models;

use App\Models\Enums\EventStatus;
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
        'event_location',
        'event_expense_amount',
        'event_participant_limit',
        'event_approval_status',
        'event_application_deadline',
        'event_thumbnail',
        'event_image',
        'event_participant',
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
}
