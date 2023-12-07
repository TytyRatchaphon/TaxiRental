<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;

    protected $table = 'insurances'; // Set the table name if it's different from the default

    protected $primaryKey = 'id'; // Set the primary key column name if it's different from the default

    protected $fillable = [
        'insurance_type',
        'company',
        'I_phonenumber',
        'start_date',
        'expired_date'
    ];

    public function taxi(){
        $this->belongsTo(Taxi::class, 'car_license');
    }

}
