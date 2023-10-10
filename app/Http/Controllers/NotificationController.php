<?php

namespace App\Http\Controllers;

use App\Models\Notification as ModelsNotification;
use App\Models\Rental;
use App\Models\User;
use App\Models\Notification;
use App\Notifications\RentalDueNotification;
use Illuminate\Http\Request;
// use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;


class NotificationController extends Controller
{
    public function totalNotification()
    {
        $currentDate = date('Y-m-d');

        $newNotification = Notification::with('rental.user')
            ->whereDate('created_at', $currentDate)
            ->where('user_id', auth()->id())
            ->where('seen', 0)
            ->count();

        return response()->json(['newNotification' => $newNotification]);
    }

    // public function showNotification()
    // {
    //     $currentDate = date('Y-m-d');

    //     $notifications = Notification::with('user')
    //         ->whereDate('created_at', $currentDate)
    //         ->orderBy('created_at', 'desc')
    //         ->get();

    //         return view('layouts.owner', compact('notifications'));

    //     //return response()->json(['notifications' => $notifications]);
    // }
}
