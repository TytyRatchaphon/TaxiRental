<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings'; // Set the table name if it's different from the default

    protected $primaryKey = 'id'; // Set the primary key column name if it's different from the default

    protected $fillable = [
        'user_id',
        'taxi_id',
        'B_status',
        'B_date'
    ];

    public function payment() {
        return $this->hasOne(Payment::class);
    }

    public function taxi(){
        return $this->belongsTo(Taxi::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
