<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_requested',
        'request_type',
        'priority',
        'description',
        'status',
    ];

    protected $casts = [
        'date_requested' => 'datetime',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    // public function property(){
    //     return $this->belongsTo(Property::class);
    // }
}
