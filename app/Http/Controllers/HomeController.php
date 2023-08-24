<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
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

    public function ownerDashboard()
    {

        return view('business_owner.owner_dashboard');
    }
}
