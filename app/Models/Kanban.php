<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kanban extends Model
{
    use HasFactory;
    protected $table = 'kanbans';

    public function event() : BelongsTo {
        return $this->belongsTo(Event::class);
    }
    public function scopeByEvent($query, $event) {
        return $query->where('event_id', $event->id);
    }
    public function scopeByStatus($query, $status) {
        return $query->where('status', $status);
    }
    public function scopeAfterToday($query) {
        return $query->where('date_deadline', '>=', Carbon::now()->toDateString());
    }
}
