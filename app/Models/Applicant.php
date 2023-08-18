<?php

namespace App\Models;

use App\Models\Enums\ApplicantStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Applicant extends Model
{
    use HasFactory;
    public function student() : BelongsTo {
        return $this->belongsTo(Student::class);
    }
    public function event() : BelongsTo {
        return $this->belongsTo(Event::class);
    }
    public function scopeByStatus($query, $status) {
        return $query->where('status', $status);
    }
}
