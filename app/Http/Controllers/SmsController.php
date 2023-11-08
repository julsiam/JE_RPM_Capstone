<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class SmsController extends Controller
{

    private function formatPhoneNumber($phoneNumber)
    {
        // Remove any non-numeric characters
        $phoneNumber = preg_replace('/\D/', '', $phoneNumber);

        // Add the country code (assuming the Philippines)
        return '+63' . substr($phoneNumber, -10);
    }

    public function sendsms()
    {
        $currentDate = date('Y-m-d');

        $rentals = Rental::with('user')
            ->where('due_date', $currentDate)
            ->where('status', 'Not Yet Paid')
            ->get();


        foreach ($rentals as $rental) {
            $receiverPhone = $this->formatPhoneNumber($rental->user->phone_number);
            $tenantName = $rental->user->first_name;
            $tenantRent = $rental->total_bill;

            $sid = getenv("TWILIO_SID");
            $token = getenv("TWILIO_TOKEN");
            $phone = getenv("TWILIO_PHONE_NUMBER");
            $twilio = new Client($sid, $token);

            $message = $twilio->messages
                ->create(
                    $receiverPhone, // to
                    [
                        "body" => "Hello $tenantName, your rental of $tenantRent is due today! Please settle!",
                        "from" => $phone
                    ]
                );
        }
        dd('Send Successfully!');
    }
}
