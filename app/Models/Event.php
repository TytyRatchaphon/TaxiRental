<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
    public function budgets() : HasMany {
        return $this->hasMany(Budget::class);
    }
    public function scopeOfUser($query, $user_id) {
        $events = Event::whereHas('users', function ($query) use ($user_id) {
            $query->where('users_id', $user_id);
        })->get();
        return $events;
    }
//    public function  {
//        $status = $this->users->pivot->where('user_id', $user_id)->status;
//    }
}
