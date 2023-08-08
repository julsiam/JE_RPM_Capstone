<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;


    protected $fillable = [
        'subject',
        'details',
        'date_created'
    ];

    protected $casts = [
        'date_created' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
