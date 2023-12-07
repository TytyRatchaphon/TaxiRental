<?php

namespace App\Models;

use App\Models\Enums\EventStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model {
    use HasFactory;

    protected $table = 'payments'; // Set the table name if it's different from the default

    protected $primaryKey = 'id'; // Set the primary key column name if it's different from the default

    protected $fillable = [
        'amount',
        'booking_id',
        'payment_method',
        'image_path',
        'P_date',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function booking(){
        return $this->belongsToMany(Booking::class);
    }
}
