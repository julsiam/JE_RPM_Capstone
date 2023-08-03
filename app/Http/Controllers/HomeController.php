<?php

namespace App\Http\Controllers;

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

    public function index()
    {
        return view('tenants.home');
        // $announcements = Announcement::orderBy('created_at', 'desc')->get();// Retrieve all announcements from the database
        // return view('tenants.home', compact ('announcements'));
    }

    public function ownerDashboard()
    {
        return view('business_owner.owner_dashboard');
    }
}
