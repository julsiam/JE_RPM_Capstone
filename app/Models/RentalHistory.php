<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalHistory extends Model
{
    use HasFactory;

    protected $fillable=[
        'rental_id',
        'start_date',
        'end_date',
        'total_rent',
        'initial_paid_amount',
        'status'
    ];

    public function rental(){
        return $this->belongsTo(Rental::class, 'rental_id');
    }

}
