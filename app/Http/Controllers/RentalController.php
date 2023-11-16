<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Property;
use App\Models\Rental;
use App\Models\RentalHistory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\SendReceiptEmail;
use App\Models\Maintenance;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RentalController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'edit_rent_from' => ['required', 'date_format:Y-m-d'],
            'edit_due_date' => ['required', 'date_format:Y-m-d'],
            'edit_water_bill' => ['required', 'numeric'],
            'edit_electric_bill' => ['required', 'numeric'],
            'edit_total_bill' => ['required', 'numeric'],
            'edit_amount_paid' => ['required', 'numeric'],
            'edit_balance' => ['required', 'numeric'],
            'edit_status' => ['string', 'in:On Going,Not Yet Paid,Paid,Not Fully Paid'],
        ]);
    }

    public function editRentalDetails(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            dd($validator->errors());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $rentalId = $request->input('rental_id');
        $rental = Rental::find($rentalId);

        if (!$rental) {
            return redirect()->back()->withErrors('Rental not found.');
        }

        // Update the rental details with the new values
        $rental->rent_from = $request->input('edit_rent_from');
        $rental->due_date = $request->input('edit_due_date');
        $rental->water_bill = $request->input('edit_water_bill');
        $rental->electric_bill = $request->input('edit_electric_bill');
        $rental->total_bill = $request->input('edit_total_bill');
        $rental->amount_paid = $request->input('edit_amount_paid');
        $rental->balance = $request->input('edit_balance');
        $rental->status = $request->input('edit_status');
        $rental->date_paid = $request->input('edit_date_updated');
        $rental->save();

        $email = $request->input('email');

        if ($request->input('edit_status') === 'Paid') {
            $mailData = [
                'date_paid' => $rental->date_paid, //or $request->input('edit_water_bill'),
                'first_name' => $rental->user->first_name, // or   'tenant_name' =>$request->input('first_name'),
                'last_name' => $rental->user->last_name,
                'rent_from' => $rental->rent_from,
                'due_date' => $rental->due_date,

                'location' => $rental->property->location,
                'room_unit' => $rental->property->room_unit,
                'room_rent' => $rental->property->room_fee,
                'water_bill' => $request->input('edit_water_bill'),
                'electric_bill' => $request->input('edit_electric_bill'),
                'amount_paid' => $request->input('edit_amount_paid'),
                'total_bill' => $request->input('edit_total_bill'),

            ];

            Mail::to($email)->send(new SendReceiptEmail($mailData));
        }


        // Find the corresponding RentalHistory record
        $existingRentalHistory = RentalHistory::where('rental_id', $rental->id)
            ->where('start_date', $rental->rent_from)
            ->where('end_date', $rental->due_date)
            ->where(function ($query) {
                $query->where('status', 'Not Yet Paid')
                    ->orWhere('status', 'Not Fully Paid');
            })
            ->first();

        if ($existingRentalHistory) {
            // Update the existing RentalHistory record
            $existingRentalHistory->total_rent = $rental->total_bill;
            $existingRentalHistory->initial_paid_amount = $rental->amount_paid;
            $existingRentalHistory->status = $rental->status;
            $existingRentalHistory->save();
        } else {
            // Create a new RentalHistory record for the new month journey
            RentalHistory::create([
                'rental_id' => $rental->id,
                'start_date' => $rental->rent_from,
                'end_date' => $rental->due_date,
                'total_rent' => $rental->total_bill,
                'initial_paid_amount' => $rental->amount_paid,
                'status' => $rental->status,
            ]);
        }

        return redirect()->route('tenants');
    }

    // FETCH LOCATIONS IN RECORDS
    public function getLocations()
    {
        $availableLocations = Property::pluck('location')->unique(); // Retrieve unique property locations

        return response()->json($availableLocations);
    }

    //GET PAID RECORDS
    public function getPaidRecords(Request $request)
    {
        $location = $request->input('location');
        $year = $request->input('year');
        $month = $request->input('month');

        $query = Rental::with(['user', 'property'])
            ->whereYear('date_paid', $year)
            ->whereMonth('date_paid', $month)
            ->where('amount_paid', '>', 0)
            ->where('status', '=', 'Paid');

        if ($location !== 'ALL') {
            $query->whereHas('property', function ($query) use ($location) {
                $query->where('location', $location);
            });
        }

        $records = $query->get();
        $totalIncome = $records->sum('amount_paid');


        return response()->json([
            'records' => $records,
            'totalIncome' => $totalIncome
        ]);
    }


    //WITH START MONTH AND END MONTH

    public function paidReport()
    {
        $rentLocations = $this->getLocations();

        $currentDate = date('Y-m-d');

        $notifications = Notification::with('user')
            ->whereDate('created_at', $currentDate)
            ->orderBy('created_at', 'desc')
            ->get();

        $newNotification = Notification::with('rental.user')
            ->whereDate('created_at', $currentDate)
            ->where('seen', 0)
            ->count();

        return view('business_owner.paid_reports', compact('notifications', 'newNotification', 'rentLocations'));
    }


    //GET PAID REPORTS
    public function getPaidReports(Request $request)
    {
        $location = $request->input('location');
        $start_month = $request->input('start_month');
        $end_month = $request->input('end_month');
        $year = $request->input('year');

        $query = RentalHistory::with(['rental.user', 'rental.property'])
            ->whereYear('start_date', $year)
            ->whereMonth('start_date', '>=', $start_month)
            ->whereMonth('end_date', '<=', $end_month)
            ->where('status', 'Paid');

        if ($location !== 'ALL') {
            $query->whereHas('rental.property', function ($query) use ($location) {
                $query->where('location', $location);
            });
        }

        $records = $query->get();
        $totalPayment = $records->sum('initial_paid_amount');

        return response()->json([
            'records' => $records,
            'totalPayment' => $totalPayment
        ]);
    }


    //UNPAID REPORTS //ROUTE TO GO TO THE PAGE

    public function unPaidReport()
    {
        $locations = $this->getLocations();

        $currentDate = date('Y-m-d');

        $notifications = Notification::with('user')
            ->whereDate('created_at', $currentDate)
            ->orderBy('created_at', 'desc')
            ->get();

        $newNotification = Notification::with('rental.user')
            ->whereDate('created_at', $currentDate)
            ->where('seen', 0)
            ->count();

        return view('business_owner.unpaid_reports', compact('notifications', 'newNotification', 'locations'));
    }



    //ALL THE RECORDS FROM PREVIOUS
    public function getUnpaidReports(Request $request)
    {
        $location = $request->input('location');
        $start_month = $request->input('start_month');
        $end_month = $request->input('end_month');
        $year = $request->input('year');

        // Query rental histories with "Not yet paid" status within the specified date range
        $unpaidRecords = RentalHistory::where('status', 'Not Yet Paid')
            ->whereYear('start_date', $year)
            ->whereMonth('start_date', '>=', $start_month)
            ->whereMonth('end_date', '<=', $end_month);

        // Optionally filter by location if it's not "ALL"
        if ($location !== 'ALL') {
            $unpaidRecords->whereHas('rental.property', function ($query) use ($location) {
                $query->where('location', $location);
            });
        }

        // Fetch the records and related rental and property data
        $unpaidRecords = $unpaidRecords->with(['rental.user', 'rental.property'])->get();

        // Calculate the total unpaid amount
        $totalUnpaid = $unpaidRecords->sum('total_rent');

        return response()->json([
            'records' => $unpaidRecords,
            'totalUnpaid' => $totalUnpaid
        ]);
    }


    public function notFullyPaidReport()
    {
        $locations = $this->getLocations();

        $currentDate = date('Y-m-d');

        $notifications = Notification::with('user')
            ->whereDate('created_at', $currentDate)
            ->orderBy('created_at', 'desc')
            ->get();

        $newNotification = Notification::with('rental.user')
            ->whereDate('created_at', $currentDate)
            ->where('seen', 0)
            ->count();

        return view('business_owner.notfullypaid_records', compact('notifications', 'newNotification', 'locations'));
    }

    //GET NOT FULLY PAID RECORDS

    public function getNotFullyPaidRecords(Request $request)
    {
        $_location = $request->input('_location');
        $start_month = $request->input('start_month');
        $end_month = $request->input('end_month');
        $_year = $request->input('year');

        $notFullRecords = RentalHistory::where('status', 'Not Fully Paid')
            // ->whereYear('start_date', $_year)
            ->whereMonth('start_date', '>=', $start_month)
            ->whereMonth('end_date', '<=', $end_month);

        if ($_location !== 'ALL') {
            $notFullRecords->whereHas('rental.property', function ($query) use ($_location) {
                $query->where('location', $_location);
            });
        }

        $notFullRecords = $notFullRecords->with(['rental.user', 'rental.property'])->get();
        $totalBalance = 0;

        foreach ($notFullRecords as $record) {
            $balance = $record->total_rent - $record->initial_paid_amount;
            $totalBalance += $balance;
        }

        // $totalBalance = $notFullRecords->sum('balance');

        // dd($notFullRecords);
        return response()->json([
            'notFullRecords' => $notFullRecords,
            'totalBalance' => $totalBalance,
        ]);
    }


    // public function getTodaysDue()
    // {
    //     $currentDate = date('Y-m-d');

    //     $tenantsWithDues = Rental::with('user', 'property')
    //         // ->where('status', 'Not Yet Paid')
    //         ->whereDate('due_date', $currentDate)
    //         // ->where(function ($query) {
    //         //     $query->where('status', 'Not Yet Paid')
    //         //         ->orWhere('amount_paid', 0.00);
    //         // })

    //         ->get();

    //     $events = [];

    //     foreach ($tenantsWithDues as $tenant) {

    //         $event = [
    //             'title' => $tenant->user->first_name . ' ' . $tenant->user->last_name, //this should be first_name and last_name
    //             'description' => 'Tenant: ' . $tenant->user->first_name . ' ' .
    //                 $tenant->user->last_name . '<br>Total Rent: ' .
    //                 $tenant->total_bill . '<br> Location: ' . $tenant->property->location,

    //             'start' => $tenant->due_date,
    //             'end' => $tenant->due_date,
    //             'status' => $tenant->status,
    //             'amount_paid' => $tenant->amount_paid

    //         ];

    //         $events[] = $event;
    //     }

    //     return response()->json($events);
    // }



    public function getEvents(Request $request)
    {
        $currentDate = now()->timezone('Asia/Singapore'); // Get the current date and time

        $dueDates = Rental::with('user', 'property')
            ->whereDate('due_date', $currentDate->toDateString())
            ->where('status', 'Not Yet Paid')
            ->where('amount_paid', 0.00)
            ->get()
            ->map(function ($rental) {
                $tenantName = $rental->user->first_name . ' ' . $rental->user->last_name;

                // $formattedDueDate = $rental->due_date->format('Y-m-d');

                return [
                    'title' => $tenantName,
                    'start' => $rental->due_date,
                    'end' => $rental->due_date,
                    'description' => 'Tenant: ' . $rental->user->first_name . ' ' .
                        $rental->user->last_name . '<br>Total Rent: ' .
                        $rental->total_bill . '<br> Location: ' . $rental->property->location,
                    'event_type' => 'due_date',
                ];
            });




        // $birthdays = User::whereBetween(DB::raw("CONCAT(MONTH(birthdate), '-', DAY(birthdate))"), [$currentDate->format('n-j'), $currentDate->addDays(7)->format('n-j')])
        //     ->get()
        //     ->map(function ($user) use ($currentDate) {
        //         $tenantName = $user->first_name . ' ' . $user->last_name;
        //         return [
        //             'title' => $tenantName,
        //             'start' => $currentDate,
        //             'end' => $currentDate,
        //             'description' => 'Tenant: ' . $user->first_name . ' ' .
        //                 $user->last_name . '<br> Location: ' . $user->property->location,
        //             'event_type' => 'birthday',
        //         ];
        //     });


        if (env('APP_ENV') == 'local') {
            // $birthdays = User::whereDate('birthdate', $currentDate->toDateString())
            $birthdays = User::whereRaw("MONTH(birthdate) = MONTH(?) AND DAY(birthdate) = DAY(?)", [$currentDate, $currentDate])
                ->get()
                ->map(function ($user) use ($currentDate) {
                    $tenantName = $user->first_name . ' ' . $user->last_name;
                    return [
                        'title' => $tenantName,
                        'start' => $currentDate,
                        'end' => $currentDate,
                        'description' => 'Tenant: ' . $user->first_name . ' ' .
                            $user->last_name . '<br> Location: ' . $user->property->location,
                        'event_type' => 'birthday',

                    ];
                });
        } else {
            // $birthdays = User::whereDate('birthdate', $currentDate->toDateString())
            $birthdays = User::whereRaw("EXTRACT(MONTH FROM birthdate::date) = EXTRACT(MONTH FROM ?::date) AND EXTRACT(DAY FROM birthdate::date) = EXTRACT(DAY FROM ?::date)", [$currentDate, $currentDate])
                ->get()
                ->map(function ($user) use ($currentDate) {
                    $tenantName = $user->first_name . ' ' . $user->last_name;
                    return [
                        'title' => $tenantName,
                        'start' => $currentDate,
                        'end' => $currentDate,
                        'description' => 'Tenant: ' . $user->first_name . ' ' .
                            $user->last_name . '<br> Location: ' . $user->property->location,
                        'event_type' => 'birthday',

                    ];
                });
        }



        $maintenances = Maintenance::with(['user', 'user.property'])
            ->whereDate('schedule', $currentDate)
            ->get()
            ->map(function ($maintenance) use ($currentDate) {
                $category = $maintenance->category; //category is what to repair in the db
                return [
                    'title' => $category,
                    'start' => $currentDate,
                    'end' => $currentDate,
                    'description' => 'Category: ' . $maintenance->category .
                        '<br> Author: ' . $maintenance->user->first_name . ' ' .
                        $maintenance->user->last_name .
                        '<br> Location: ' . $maintenance->user->property->location,
                    'event_type' => 'maintenance',
                ];
            });


        $events = $dueDates->concat($birthdays)->concat($maintenances);

        return response()->json($events);
    }
}
