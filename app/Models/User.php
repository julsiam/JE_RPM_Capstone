<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    //SoftDeletes;

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
        'type',
        'profile_picture',
        'status'
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
        'birthdate' => 'datetime',
        'password' => 'hashed',
    ];

    protected function type(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ['tenant', 'business_owner'][$value],
        );
    }

    public function property()
    {
        return $this->hasOne(Property::class);
    }

    public function rental()
    { //should be rentals
        return $this->hasOne(Rental::class);
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function maintenance()
    {
        return $this->hasMany(Maintenance::class);
    }

    public function file()
    {
        return $this->hasMany(File::class);
    }

    public function notification()
    {
        return $this->hasMany(Notification::class);
    }

    public function tenantProperty()
    {
        return $this->hasOne(TenantProperty::class);
    }

    // protected $cascadeDeletes =
    // [
    //     'property',
    //     'rental',
    //     'announcements',
    //     'maintenance',
    //     'file'
    // ];
}
