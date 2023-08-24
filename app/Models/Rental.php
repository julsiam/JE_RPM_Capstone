<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'property_id',
        'rent_started',
        'rent_from',
        'due_date',
        'water_bill',
        'electric_bill',
        'total_bill',
        'amount_paid',
        'balance',
        'status'
    ];

    public function tenant(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function property(){
        return $this->belongsTo(Property::class, 'property_id');
    }
}
