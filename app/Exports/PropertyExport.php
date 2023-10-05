<?php

namespace App\Exports;

use App\Models\Property;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PropertyExport implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        $query =  Property::raw("CONCAT(users.first_name,' ',users.last_name)");

        return Property::select(
            'properties.location',
            'properties.room_unit',
            'properties.room_fee',
            $query,
            'properties.status',
            'properties.inclusion'

        )
            ->join('users',
            'properties.user_id', '=', 'users.id');
    }


    public function headings(): array
    {
        return [
            'Location',
            'Room Unit',
            'Room Fee',
            'Occupant',
            'Status',
            'Inclusions',
        ];
    }
}
