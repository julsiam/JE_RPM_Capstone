<?php

namespace App\Console\Commands;

use App\Models\Rental;
use Illuminate\Console\Command;
use Twilio\Rest\Client;


class SendDueDateNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:send-due-date-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send SMS notification to tenantd with due date on the current date.';

    /**
     * Execute the console command.
     */

     private function formatPhoneNumber($phoneNumber)
     {
         // Remove any non-numeric characters
         $phoneNumber = preg_replace('/\D/', '', $phoneNumber);

         // Add the country code (assuming the Philippines)
         return '+63' . substr($phoneNumber, -10);
     }

    public function handle()
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
        $this->info('SMS notifications for tenants with due date today sent successfully.');
    }
}
