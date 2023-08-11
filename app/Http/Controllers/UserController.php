<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Rental;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


use Illuminate\Http\Request;

class UserController extends Controller
{

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'numeric', 'digits_between:10,11'], // change to numeric and add digits_between rule
            'age' => ['required', 'integer', 'min:2'], // add integer and min rule
            'birthdate' => ['required', 'date_format:Y-m-d', 'before_or_equal:today'], // add before_or_equal rule to ensure the birthdate is not in the future
            'gender' => ['string', 'in:Male,Female'], // add in rule to ensure the gender is one of the allowed values
            'address' => ['required', 'string', 'max:255'],
            'occupation' => ['required', 'string', 'max:255'],
            'work_address' => ['string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'type' => ['integer'], // add integer rule for type field

            'water_bill' => ['required', 'numeric'],
            'electric_bill' => ['required', 'numeric'],
            'total_bill' => ['required', 'numeric'],
            'due_date' => ['required', 'date_format:Y-m-d', 'after:today'],
            'status' => ['string', 'in:On Going,Not Yet Paid,Paid,Not Fully Paid'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    //ADD TENANT
    protected function addTenant(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $propertyId = $request->input('property_id');

        $property = Property::where('id', $propertyId)
            ->where('status', 'Available')
            ->first();

        if (!$property) {
            // Property not found or already occupied, handle the error here
            return redirect()->back()->with('error', 'Selected property is not available or does not exist.');
        }


        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
            'age' => $request->input('age'),
            'birthdate' => $request->input('birthdate'),
            'gender' => $request->input('gender'),
            'address' => $request->input('address'),
            'occupation' => $request->input('occupation'),
            'work_address' => $request->input('work_address'),
            'type' => 0,
            'property_id' => $propertyId,
            'password' => Hash::make($request->input('password')),

        ]);

        $rental = Rental::create([
            'user_id' => $user->id,
            'property_id' => $propertyId,
            'rent_started' => $request->input('rent_started'),
            'due_date' => $request->input('due_date'),
            'water_bill' => $request->input('water_bill'),
            'electric_bill' => $request->input('electric_bill'),
            'total_bill' => $request->input('total_bill'),
            'status' => $request->input('rentalStatus'),
        ]);

        $property->user_id = $user->id; // Update the user_id
        $property->status = 'Occupied'; // Update the status to Occupied
        $property->save();

        //FOR MODAL
        // session()->flash('tenant_added', true);

        return redirect()->route('tenants');
    }


    //SHOW THE LOCATION DROPDOWN AS WELL

    public function showAddTenantForm()
    {
        $locations = $this->getLocationOptions();
        return view('business_owner.add_tenant', compact('locations'));
    }

    public function getLocationOptions()
    {
        $locations = Property::select('location')->distinct()->get();
        return $locations;
    }


    public function getRoomUnits(Request $request)
    {
        try {
            $location = $request->input('location');
            $roomUnits = Property::where('location', $location)
                ->where('status', 'Available') // Filter by status 0 (available)
                ->pluck('room_unit');
            return response()->json($roomUnits);
        } catch (\Exception $e) {
            Log::error('Error in getRoomUnits: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    public function getRoomDetails(Request $request)
    {
        $location = $request->input('location');
        $roomUnit = $request->input('room_unit');
        $roomDetails = Property::where('location', $location)
            ->where('room_unit', $roomUnit)
            ->first();

        return response()->json($roomDetails);
    }




    //SHOW ALL TENANTS

    public function tenantsList()
    {
        $tenants = User::where('type', 0)
            ->get();
        // ->paginate(10);

        $totalTenants = User::where('type', 0)->count();

        return view('business_owner.tenants', compact('tenants', 'totalTenants'));
    }


    public function sortByLocation()
    {
        $sortedByLocation = User::where('type', 0)
            ->with(['property' => function ($query) {
                $query->orderBy('location', 'asc');
            }])
            ->get();

        return view('business_owner.tenants', ['tenants' => $sortedByLocation]);
    }





    //SHOW ALL TENANTS AND DISPLAY IN MODAL
    public function getTenantsList()
    {
        $tenants = User::where('type', 0)->select('id', 'first_name', 'last_name', 'email')->get();
        return response()->json($tenants);
    }


    public function getTenantDetails(Request $request)
    {
        $id = $request->input('id');
        $tenant = User::with('rental.property')->findOrFail($id);

        return response()->json($tenant);
    }
}
