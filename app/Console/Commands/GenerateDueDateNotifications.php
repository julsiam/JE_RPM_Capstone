<?php

namespace App\Console\Commands;

use App\Models\Notification;
use App\Models\Rental;
use App\Models\User;
use App\Notifications\RentalDueNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateDueDateNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:create';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create notifications for business owners about tenants with due dates today';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentDate = Carbon::today();

        $tenants = User::where('type', 0)
            ->whereHas('rental', function ($query) use ($currentDate) {
                $query->whereDate('due_date', $currentDate);
            })
            ->get();


        foreach ($tenants as $tenant) {
            $notification = new Notification([
                'user_id' =>  $tenant->id,
                'message' => $tenant->name . ' has a due date today!',
            ]);
            $notification->save();
        }

        $this->info('Due date notifications for the admin generated successfully.');
    }

}
