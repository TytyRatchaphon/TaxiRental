<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserStudent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'major', 'faculty', 'year', 'role'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
