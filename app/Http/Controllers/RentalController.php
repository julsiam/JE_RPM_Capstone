<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Rental;
use App\Models\RentalHistory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RentalController extends Controller
{

    // public function getRentalDetails(Request $request)
    // {
    //     $id = $request->input('id');
    //     $rentals = Rental::where('user_id', $id)->with('property')->get();

    //     return response()->json($rentals);
    // }

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
            ->where('status', 'Not yet paid') // Only update if status is "Not yet paid"
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


    // public function paidRecord()
    // {
    //     $availableLocations = $this->getLocations();

    //     return view('business_owner.paid_records', compact('availableLocations'));
    // }


    //GET PAID RECORDS
    // public function getPaidRecords(Request $request)
    // {
    //     $location = $request->input('location');
    //     $year = $request->input('year');
    //     $month = $request->input('month');

    //     $query = Rental::with(['user', 'property'])
    //         ->whereYear('date_paid', $year)
    //         ->whereMonth('date_paid', $month)
    //         ->where('amount_paid', '>', 0)
    //         ->where('status', '=', 'Paid');

    //     if ($location !== 'ALL') {
    //         $query->whereHas('property', function ($query) use ($location) {
    //             $query->where('location', $location);
    //         });
    //     }

    //     $records = $query->get();
    //     $totalIncome = $records->sum('amount_paid');


    //     return response()->json([
    //         'records' => $records,
    //         'totalIncome' => $totalIncome
    //     ]);
    // }



    // public function notYetPaidRecord()
    // {
    //     $availableLocations = $this->getLocations();

    //     return view('business_owner.notyetpaid_records', compact('availableLocations'));
    // }

    //GET NOT YET PAID RECORDS
    // public function getNotPaidRecords(Request $request)
    // {
    //     $selectedLocation = $request->input('location');
    //     $selectedMonth = $request->input('month');
    //     $selectedYear = $request->input('year');

    //     $query = Rental::with(['user', 'property'])
    //         ->whereYear('due_date', $selectedYear)
    //         ->whereMonth('due_date', $selectedMonth)
    //         ->where('amount_paid', 0)
    //         ->where('status', '=', 'Not Yet Paid');

    //     if ($selectedLocation !== 'ALL') {
    //         $query->whereHas('property', function ($query) use ($selectedLocation) {
    //             $query->where('location', $selectedLocation);
    //         });
    //     }


    //     $records = $query->get();
    //     $totalUnpaid = $records->sum('total_bill');

    //     return response()->json([
    //         'records' => $records,
    //         'totalUnpaid' => $totalUnpaid
    //     ]);
    // }


    // public function notFullyPaidRecord()
    // {
    //     $availableLocations = $this->getLocations();

    //     return view('business_owner.notfullypaid_records', compact('availableLocations'));
    // }

    //GET NOT FULLY PAID RECORDS
    // public function getNotFullyPaidRecords(Request $request)
    // {
    //     $selectedLocation = $request->input('location');
    //     $selectedMonth = $request->input('month');
    //     $selectedYear = $request->input('year');

    //     $query = Rental::with(['user', 'property'])
    //         ->whereYear('due_date', $selectedYear)
    //         ->whereMonth('due_date', $selectedMonth)
    //         ->where('balance', '>', 0)
    //         ->where('status', '=', 'Not Fully Paid');

    //     if ($selectedLocation !== 'ALL') {
    //         $query->whereHas('property', function ($query) use ($selectedLocation) {
    //             $query->where('location', $selectedLocation);
    //         });
    //     }


    //     $records = $query->get();
    //     $totalBalance = $records->sum('balance');
    //     $totalInitialPayment = $records->sum('amount_paid');

    //     // dd($records);
    //     return response()->json([
    //         'records' => $records,
    //         'totalBalance' => $totalBalance,
    //         'totalInitialPayment' => $totalInitialPayment
    //     ]);
    // }


    //WITH START MONTH AND END MONTH

    public function paidReport()
    {
        $rentLocations = $this->getLocations();

        return view('business_owner.paid_reports', compact('rentLocations'));
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


    //UNPAID REPORTS

    public function unPaidReport()
    {
        $locations = $this->getLocations();

        return view('business_owner.unpaid_reports', compact('locations'));
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
