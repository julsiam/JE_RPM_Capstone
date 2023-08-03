<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $properties = [
            [
                'location' => 'Danao City, Cebu',
                'room_unit' => 'JE_RPM_001',
                'room_fee' => 5000.00,
                'status' => 0, //0 - available 1 - not available
            ],
            [
                'location' => 'Consolaction City',
                'room_unit' => 'JE_RPM_001',
                'room_fee' => 5000.00,
                'status' => 1, //0 - available 1 - not available
            ],
            [
                'location' => 'Cebu City',
                'room_unit' => 'JE_RPM_001',
                'room_fee' => 5000.00,
                'status' => 1, //0 - available 1 - not available
            ],
            [
                'location' => 'Danao Cebu',
                'room_unit' => 'JE_RPM_001',
                'room_fee' => 5000.00,
                'status' => 0, //0 - available 1 - not available
            ],

        ];
        foreach ($properties as $propertyData){
            Property::create($propertyData);
        }
    }
}
