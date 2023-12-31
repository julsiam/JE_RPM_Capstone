<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Maintenance;
use App\Models\Notification;
use App\Models\Property;
use App\Models\Rental;
use App\Models\RentalHistory;
use App\Models\User;
use Carbon\Carbon;
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
        $currentMonth = Carbon::now()->month;

        $avail_locs = $this->getLocs();

        $selectedLocation = $request->input('locs');

        $totalTenants = User::where('type', 0)
            ->where('status', 'Active')
            ->count();


        $totalProperties = Property::count();

        $occupiedProperties = Property::where('status', 'Occupied')->count();

        $availProperties = Property::where('status', 'Available')->count();

        $totalMaintenance = Maintenance::where('status', 'Pending')
            ->count();

        $currentDate = date('Y-m-d');

        $notifications = Notification::with('user')
            ->whereDate('created_at', $currentDate)
            ->orderBy('created_at', 'desc')
            ->get();

        $newNotification = Notification::with('rental.user')
            ->whereDate('created_at', $currentDate)
            ->where('seen', 0)
            ->count();


        $totalMonthIncome = RentalHistory::whereMonth('end_date', $currentMonth) //current month
            ->where('initial_paid_amount', '>', 0)
            ->where('status', 'Paid')
            ->sum('initial_paid_amount');

        return view(
            'business_owner.owner_dashboard',
            compact('notifications', 'newNotification', 'totalTenants', 'totalProperties', 'occupiedProperties', 'availProperties', 'totalMaintenance', 'avail_locs', 'totalMonthIncome')
        );
    }


    public function getTenantCountByLocation(Request $request)
    {
        $selectedLocation = $request->input('location');

        if ($selectedLocation === 'ALL') {

            $tenantCount = User::where('type', 0)
                ->where('status', 'Active')
                ->count();
        } else {
            $tenantCount = User::with('property')
                ->where('type', 0)
                ->where('status', 'Active')
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

    public function getTotalIncome(Request $request)
    {
        $month = $request->input('month');

        $totalIncome = RentalHistory::whereMonth('end_date', $month) //current month
            ->where('initial_paid_amount', '>', 0)
            // ->where('status', 'Paid')
            ->sum('initial_paid_amount');

        return response()->json(['totalIncome' => $totalIncome]);
    }



    public function lineChart(Request $request)
    {
        $selectedYear = $request->input('year', date('Y'));

        $locations = Property::distinct()->pluck('location')->toArray();

        $locationData = [];

        foreach ($locations as $location) {
            $data = RentalHistory::whereHas('rental.property', function ($query) use ($location, $selectedYear) {
                $query->where('location', $location);
                $query->whereYear('end_date', $selectedYear);
            })->get(['end_date', 'initial_paid_amount']);

            $monthlyData = [];

            foreach ($data as $record) {
                $endDate = Carbon::parse($record->end_date);

                // Add the initial_paid_amount to the corresponding month
                $monthKey = $endDate->format('F'); // Format month as a key (e.g., 'November', 'December', etc.)
                if (!isset($monthlyData[$monthKey])) {
                    $monthlyData[$monthKey] = 0;
                }

                $monthlyData[$monthKey] += $record->initial_paid_amount;
            }

            $initialPaidSum = array_sum($monthlyData);

            $locationData[$location] = [
                'totalPaid' => $monthlyData,
                'initialPaidSum' => $initialPaidSum,
            ];
        }

        // // Dump and die to inspect the data
        // dd($locationData);

        // Return the JSON response
        return response()->json(['locations' => $locations, 'locationData' => $locationData]);
    }
}
