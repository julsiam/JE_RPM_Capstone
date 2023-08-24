<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = [
            // [
            //     'first_name' => 'Juls',
            //     'last_name' => 'Estorco',
            //     'phone_number' => 9514791515,
            //     'email' => 'julsestorco031602@gmail.com',
            //     'age' => 21,
            //     'birthdate' => '2002-03-16',
            //     'gender' => 'Male',
            //     'address' => 'Cebu City, Cebu',
            //     'occupation' => 'IT Professional',
            //     'work_address' => "Cebu City",
            //     'password' => bcrypt('juls12345'),
            //     'type' => 0
            // ],
            [
                'first_name' => 'Christine',
                'last_name' => 'Toledo',
                'phone_number' => 9554800304,
                'email' => '21103811@usc.edu.ph',
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
