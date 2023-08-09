<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventUserList extends Model
{
    use HasFactory;
    protected $table = 'event_user';
    protected $primaryKey = ['event_id', 'user_id'];
    protected $fillable = [
        'event_id',
        'user_id',
        'approval_event',
        'is_staff_event',
        'is_head_event'
    ];
}
