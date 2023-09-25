<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Maintenance;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function getAnnouncements()
    {
        $propertyLocation = auth()->user()->property->location;

        $announcements = Announcement::where(function ($query) use ($propertyLocation) {
            $query->where('location', $propertyLocation)
                ->orWhere('location', 'ALL');
        })->orderBy('created_at', 'desc')->get();

        return view('tenants.home', compact('announcements'));
    }

    public function getLocs()
    {
        $availLocs = Property::pluck('location')->unique();

        return response()->json($availLocs);
    }


    public function ownerDashboard(Request $request)
    {
        $avail_locs = $this->getLocs();

        $selectedLocation = $request->input('locs');

        $totalTenants = User::where('type', 0)->count();


        $totalProperties = Property::count();

        $occupiedProperties = Property::where('status', 'Occupied')->count();

        $availProperties = Property::where('status', 'Available')->count();

        $totalMaintenance = Maintenance::count();


        return view(
            'business_owner.owner_dashboard',
            compact('totalTenants', 'totalProperties', 'occupiedProperties', 'availProperties', 'totalMaintenance', 'avail_locs')
        );
    }


    public function getTenantCountByLocation(Request $request)
    {
        $selectedLocation = $request->input('location');

        if ($selectedLocation === 'ALL') {

            $tenantCount = User::where('type', 0)->count();
        } else {
            $tenantCount = User::with('property')
                ->where('type', 0)
                ->whereHas('property', function ($query) use ($selectedLocation) {
                    $query->where('location', $selectedLocation);
                })
                ->count();
        }

        return response()->json(['tenantCount' => $tenantCount]);
    }

    public function getPropertiesCountByLocation(Request $request)
    {
        $selectedPropertyLocation = $request->input('location');


        if ($selectedPropertyLocation === 'ALL') {

            $total_properties = Property::count();

            $totalOccupied = Property::where('status', 'Occupied')
                ->count();

            $totalAvailable = Property::where('status', 'Available')
                ->count();
        } else {
            $total_properties = Property::where('location', $selectedPropertyLocation)
                ->count();

            $totalAvailable = Property::where('location', $selectedPropertyLocation)
                ->where('status', 'Available')
                ->count();

            $totalOccupied = Property::where('location', $selectedPropertyLocation)
                ->where('status', 'Occupied')
                ->count();
        }

        return response()->json([
            'total_properties' => $total_properties,
            'totalOccupied' => $totalOccupied,
            'totalAvailable' => $totalAvailable
        ]);
    }
}