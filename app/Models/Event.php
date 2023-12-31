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
        'car_license',
        'car_status',
        'registration_no',
        'car_color',
        'car_year',
        'car_image',
        'insurance',
    ];




    public function hasStudentInEvent($student) {
        return $this->students()->where('student_id', $student->id)->exists();
    }
    
    public function scopeByStatusEvent($query, $status) {
        return $query->where('car_status', $status);
    }

    public function scopeForSerch($query, $input){
        return $query->where(function ($query) use ($input){
            $query->where('','LIKE',"{%input}");
        });
    }
}
