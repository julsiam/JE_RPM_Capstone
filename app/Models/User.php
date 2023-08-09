<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'property_id',
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'age',
        'birthdate',
        'gender',
        'address',
        'occupation',
        'work_address',
        'password',
        'type'
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

    protected function type(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["tenant", "business_owner"][$value],
        );
    }

    public function property()
    {
        return $this->hasOne(Property::class);
    }

    public function rental(){
        return $this->hasOne(Rental::class);
    }

    public function announcements(){
        return $this->hasMany(Announcement::class);
    }

    public function maintenance(){
        return $this->hasMany(User::class);
    }
}
