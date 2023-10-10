<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Notification;
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

        $currentDate = date('Y-m-d');

        $notifications = Notification::with('user')
            ->whereDate('created_at', $currentDate)
            ->orderBy('created_at', 'desc')
            ->get();

        $newNotification = Notification::with('rental.user')
            ->whereDate('created_at', $currentDate)
            ->where('seen', 0)
            ->count();


        return view('business_owner.announcement', compact('announcements', 'notifications','newNotification', 'availableLocations'));
    }

    public function getAnnouncement(Request $request)
    {
        $announcementId = $request->input('data-announcement-id');
        $announcement = Announcement::findOrFail($announcementId);

        return response()->json($announcement);
    }

    public function editAnnouncement(Request $request) //for business owner STATUS UPDATE
    {
        $announcementId = $request->input('edit_announcement_id'); //from the hidden field of id
        $announcement = Announcement::find($announcementId);

        $announcement->subject = $request->input('edit_subject');
        $announcement->details = $request->input('edit_details');
        $announcement->location = $request->input('editLocation');

        $announcement->update();
        return redirect()->route('announcements')->with('success', 'Announcement updated!');
    }


    public function deleteAnnouncement(Request $request)
    {

        $announcement = Announcement::find($request->announcement_delete_id);
        $announcement->delete();

        return redirect()->route('announcements')->with('delete', 'Deleted Successfully!');
    }
}
