<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'major',
        'faculty',
        'year',
        'role',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
    public function applicants() : HasMany {
        return $this->hasMany(Applicant::class);
    }
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
