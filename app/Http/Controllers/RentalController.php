<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Property;
use App\Models\Rental;
use App\Models\RentalHistory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $rental->save();

        // Find the corresponding RentalHistory record
        $existingRentalHistory = RentalHistory::where('rental_id', $rental->id)
            ->where('start_date', $rental->rent_from)
            ->where('end_date', $rental->due_date)
            ->where(function($query){
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

        return view('business_owner.paid_reports', compact('notifications', 'newNotification','rentLocations'));
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

        return view('business_owner.unpaid_reports', compact('notifications', 'newNotification','locations'));
    }



    //ALL THE RECORDS FROM PREVIOUS
    public function getUnpaidReports(Request $request)
    {
        $location = $request->input('location');
        $start_month = $request->input('start_month');
        $end_month = $request->input('end_month');
        $year = $request->input('year');

        // Query rental histories with "Not yet paid" status within the specified date range
        $unpaidRecords = RentalHistory::where('status', 'Not yet paid')
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

        return view('business_owner.notfullypaid_records', compact('notifications', 'newNotification','locations'));
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




    public function getTodaysDue()
    {
        $currentDate = date('Y-m-d');

        $tenantsWithDues = Rental::with('user', 'property')
            //->where('status', 'Not Yet Paid')
            ->whereDate('due_date', $currentDate)
            // ->where(function ($query) {
            //     $query->where('status', 'Unpaid')
            //         ->orWhere('amount_paid', 0);
            // })
            ->get();

        $events = [];

        foreach ($tenantsWithDues as $tenant) {

            $event = [
                'title' => $tenant->user->first_name . ' ' . $tenant->user->last_name, //this should be first_name and last_name
                'description' => 'Tenant: ' . $tenant->user->first_name . ' ' .
                    $tenant->user->last_name . '<br>Total Rent: ' .
                    $tenant->total_bill . '<br> Location: ' . $tenant->property->location,

                'start' => $tenant->due_date,
                'end' => $tenant->due_date,
                'status' => $tenant->status,
                'amount_paid' => $tenant->amount_paid

            ];

            $events[] = $event;
        }

        return response()->json($events);
    }
}
