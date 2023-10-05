<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TenantsExport implements FromQuery, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        $query =  User::raw("CONCAT(users.first_name,' ',users.last_name)");

        return User::select(
            $query,
            'users.email',
            'users.phone_number',
            'users.birthdate',
            'users.age',
            'users.gender',
            'properties.location',
            'properties.room_unit',
            'properties.room_fee'
        )
            ->where('users.type', 0)
            ->join('properties',
            'users.property_id', '=', 'properties.id');
    }


    public function headings(): array
    {
        return [
            'Tenant',
            'Email',
            'Phone Number',
            'Birthdate',
            'Age',
            'Gender',
            'Location',
            'Room Unit',
            'Room Fee',
        ];
    }
}
