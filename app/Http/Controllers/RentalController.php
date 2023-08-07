<?php

namespace App\Http\Controllers;

use App\Models\Rental;
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
            'water_bill' => ['required', 'numeric'],
            'electric_bill' => ['required', 'numeric'],
            'total_bill' => ['required', 'numeric'],
            'due_date' => ['required', 'date_format:Y-m-d', 'after:today'],
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

        Log::info('Edit Rental Details method called.');


        $rentalId = $request->input('rental_id');
        $rental = Rental::find($rentalId);

        Log::info('Rental: ' . print_r($rental, true));


        if (!$rental) {
            return redirect()->back()->withErrors('Rental not found.');
        }

        // Update the rental details with the new values
        $rental->water_bill = $request->input('water_bill');
        $rental->electric_bill = $request->input('electric_bill');
        $rental->total_bill = $request->input('total_bill');
        $rental->due_date = $request->input('due_date');
        $rental->status = $request->input('status');
        $rental->save();

        session()->flash('success', 'Rental details updated successfully.');

        return redirect()->route('tenants');
    }
}
