<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
    protected $fillable = [
        'user_firstname',
        'user_lastname',
        'username',
        'user_profile_img',
        'email',
        'password',
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
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function student()
    {
        return $this->hasOne(Student::class);
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
    public function scopeForSearch($query, $input) {
        return $query->where(function ($query) use ($input) {
            $query->where('username', 'LIKE', "%{$input}%")
                ->orWhere('user_firstname', 'LIKE', "%{$input}%")
                ->orWhere('user_lastname', 'LIKE', "%{$input}%");
        })->limit(5);
    }
}
