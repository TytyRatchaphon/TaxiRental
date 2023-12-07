<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';

    protected $primaryKey = 'id';
    protected $fillable = [
        'F_name',
        'L_name',
        'email',
        'id_card_number',
        'password',
        'pb_license',
        'license_id',
        'phone_number',
        'user_profile_img',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];
    public function taxi(){
        return $this->hasOne(Booking::class);
    }
    public function payment(){
        return $this->hasMany(Payment::class);
    }

    public function user(){
        return $this->hasOne(Booking::class);
    }
    public function isRole($role) {
        if ($this->role === $role) {
            return true;
        } else {
            return false;
        }
    }
    public function scopeByRole($query, $role) {
        return $query->where('role', $role);
    }
    public function getName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    public function scopeForSearch($query, $input) {
        return $query->where(function ($query) use ($input) {
            $query->where('username', 'LIKE', "%{$input}%");
        })->limit(5);
    }
}
