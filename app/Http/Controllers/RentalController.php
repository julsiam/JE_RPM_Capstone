<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Rental;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'due_date' => ['required', 'date_format:Y-m-d', 'after:today'],
            'water_bill' => ['required', 'numeric'],
            'electric_bill' => ['required', 'numeric'],
            'total_bill' => ['required', 'numeric'],
            'amount_paid' => ['required', 'numeric'],
            'balance' => ['required', 'numeric'],
            'status' => ['string', 'in:On Going,Not Yet Paid,Paid,Not Fully Paid'],
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
        $rental->due_date = $request->input('due_date');
        $rental->water_bill = $request->input('water_bill');
        $rental->electric_bill = $request->input('electric_bill');
        $rental->total_bill = $request->input('total_bill');
        $rental->amount_paid = $request->input('amount_paid');
        $rental->balance = $request->input('balance');
        $rental->status = $request->input('status');
        $rental->save();

        session()->flash('success', 'Rental details updated successfully.');

        return redirect()->route('tenants');
    }

    //FETCH LOCATIONS IN RECORDS
    public function getLocations()
    {
        $availableLocations = Property::pluck('location')->unique(); // Retrieve unique property locations

        return response()->json($availableLocations);
    }


    public function paidRecord()
    {
        $availableLocations = $this->getLocations();

        return view('business_owner.paid_records', compact('availableLocations'));
    }

    public function getAvailLocations()
    {
        $availableLocations = Property::pluck('location')->unique(); // Retrieve unique property locations

        return response()->json($availableLocations);
    }

    public function notYetPaidRecord()
    {
        $availableLocations = $this->getAvailLocations();
        // dd($availableLocations);

        return view('business_owner.notyetpaid_records', compact('availableLocations'));
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
            ->where('amount_paid', '>', 0);

            if ($location !== 'ALL'){
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


    // public function getPaidRecords(Request $request)
    // {
    //     $location = $request->input('paidLocations');
    //     $month = $request->input('month');
    //     $year = $request->input('year');

    //     $paidRecords = Rental::whereHas('user.property', function ($query) use ($location) {
    //         if ($location !== 'ALL') {
    //             $query->where('location', $location);
    //         }
    //     })
    //         ->whereMonth('due_date', $month)
    //         ->whereYear('due_date', $year)
    //         ->where('status', 'Paid')
    //         ->get();
    //     dd($paidRecords);

    //     return response()->json($paidRecords);
    // }
}
