<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Add the tenant_id to the $fillable array
        'location',
        'room_unit',
        'inclusion',
        'room_fee',
        'status',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rental()
    {
        return $this->hasOne(Rental::class, 'property_id');
    }

    public function resetForNewTenant()
    {
        $this->update([
            'user_id' => null,
            'status' => 'Available',
        ]);
    }
}
