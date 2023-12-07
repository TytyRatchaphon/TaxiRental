<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Taxi extends Model{
    use HasFactory;
    
    protected $table = 'taxis'; // Set the table name if it's different from the default

    protected $primaryKey = 'id'; // Set the primary key column name if it's different from the default

    protected $fillable = [
        'user_id',
        'car_license',
        'registration_no',
        'car_color',
        'car_model',
        'car_image'
    ];

    public function insurance(){
        return $this->hasMany(Insurance::class, 'car_license');
    }
    public function booking(){
        return $this->hasMany (Booking::class);
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
