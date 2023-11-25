<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantProperty extends Model //tenant property history
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'location',
        'room_unit',
        'room_fee',
    ];


    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
