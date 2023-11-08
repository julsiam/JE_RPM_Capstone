<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = [
            [
                'first_name' => 'Christine',
                'last_name' => 'Toledo',
                'phone_number' => 9554800304,
                'email' => 'je.rentals2023@gmail.com',
                'age' => 28,
                'birthdate' => '1995-02-15',
                'gender' => 'Female',
                'address' => 'Cebu City, Cebu',
                'occupation' => 'Business Woman',
                'work_address' => "Cebu City",
                'password' => bcrypt('chris12345'),
                'type' => 1
            ]
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
