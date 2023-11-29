<?php

namespace App\Console\Commands;

use App\Mail\DueEmail;
use App\Models\Rental;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDueEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:send-due-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notification for tenants with due date today!';

    /**
     * Execute the console command.
     */
    public function handle()
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
        $this->info('Email notification for tenants with due date today sent successfully.');
    }
}
