<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{

    public function getAnnouncementLocations()
    {
        $availableLocations = Property::pluck('location')->unique(); // Retrieve unique property locations

        return response()->json($availableLocations);
    }

    public function addAnnouncement(Request $request)
    {

        $user = Auth::user(); // Retrieve the authenticated user
        $announcement = new Announcement();
        $announcement->user_id = $user->id; // Assign the user's ID to the user_id field
        $announcement->subject = $request->input('subject');
        $announcement->details = $request->input('details');
        $announcement->location = $request->input('visibleLocation');
        $announcement->save();

        return redirect()->route('announcements')->with('success', "Successly posted an announcement!"); // Redirect to the announcement view page
    }

    public function getAnnouncements()
    {
        $announcements = Announcement::orderBy('created_at', 'desc')->get(); // Retrieve all announcements from the database

        $availableLocations = $this->getAnnouncementLocations();

        return view('business_owner.announcement', compact('announcements', 'availableLocations'));
    }

    public function deleteAnnouncement(Request $request){

        $announcement = Announcement::find($request->announcement_delete_id);
        $announcement->delete();

        return redirect()->route('announcements')->with('delete', 'Deleted Successfully!');
    }


    // public function deleteAnnouncement(Announcement $announcement){
    //     $announcement->delete();

    //     return redirect()->route('announcements')->with('success', 'Deleted Successfully!');
    // }
}
