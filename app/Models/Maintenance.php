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
        'category',
        'priority',
        'description',
        'schedule',
        'status'
    ];

    protected $casts = [
        'date_requested' => 'datetime',
        'schedule' => 'datetime',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
