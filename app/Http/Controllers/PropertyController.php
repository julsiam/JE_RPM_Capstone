<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;


class PropertyController extends Controller
{
    // public function getRoomUnits(Request $request)
    // {
    //     $selectedLocation = $request->input('location');

    //     // Fetch room units based on the selected location and status (e.g., status 0 for available rooms)
    //     $roomUnits = Property::where('location', $selectedLocation)
    //         ->where('status', 0)
    //         ->get(['id', 'room_unit']);

    //     return response()->json($roomUnits);
    // }

    // public function showAddTenantForm()
    // {
    //     $locations = $this->getLocationOptions();
    //     return view('business_owner.add_tenant', compact('locations'));
    // }

    // public function locations()
    // {
    //     $locations = $this->getLocationOptions();
    //     return view('business_owner.add_tenant', compact('locations'));
    // }

    // public function getLocationOptions()
    // {
    //     $locations = Property::select('location')->distinct()->get();
    //     return $locations;
    // }
}
