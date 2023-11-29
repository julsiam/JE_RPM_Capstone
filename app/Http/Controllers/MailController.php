<?php

namespace App\Http\Controllers;

use App\Mail\DueEmail;
use Illuminate\Http\Request;
use App\Mail\SendReceiptEmail;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

    public function sendDueDateEmail()
    {
        $currentDate = date('Y-m-d');

        $rentals = Rental::with('user')
            ->where('due_date', $currentDate)
            ->where('status', 'Not Yet Paid')
            ->get();

        foreach ($rentals as $rental) {
            $tenantName = $rental->user->first_name;
            $tenantRent = $rental->total_bill;

            Mail::to($rental->user->email)->send(new DueEmail($tenantName, $tenantRent));

        }
    }




    // public function sendReceiptEmail()
    // {
    //     $mailData = [
    //         'date_paid' => '$rental->due_date,', //or $request->input('edit_water_bill'),
    //         'first_name' => '$rental->user->first_name', // or   'tenant_name' =>$request->input('first_name'),
    //         'last_name' => '$rental->user->last_name',
    //         'rent_from' => '$rental->rent_from',
    //         'due_date' => '$rental->due_date',

    //         'location' => '$rental->property->location',
    //         'room_unit' => '$rental->property->room_unit',
    //         'room_rent' => '$rental->property->room_fee',
    //         'water_bill' => '$request->input',
    //         'electric_bill' => '$request->input',
    //         'amount_paid' => 'gfhdfhdfhgdh',
    //         'total_bill' => 'gfhfdhdfhhdf',

    //     ];

    //     Mail::to('21103811@usc.edu.ph')->send(new SendReceiptEmail($mailData));

    //     dd('Receipt send!');
    // }
}
