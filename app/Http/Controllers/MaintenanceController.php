<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceController extends Controller
{
    public function getMaintenances(Request $request)
    {

        $maintenance = Maintenance::with('user')->get(); //get ALL
        $totalMaintenance = $maintenance->count();

        return view('business_owner.maintenance', compact('maintenance', 'totalMaintenance'));
    }

    public function getMaintenance(Request $request) //get ONE
    {
        $maintenanceId = $request->input('data-maintenance-id'); //from the ID built sa button
        $maintenance = Maintenance::with('user.property')->findOrFail($maintenanceId);

        return response()->json($maintenance);
    }

    public function getMyMaintenance() //my own request
    {
        $user = Auth::user()->maintenance->first();
        $maintenanceRequest = $user->maintenances;
        $totalRequest = $maintenanceRequest->count();

        return view('tenants.maintenance', compact('maintenanceRequest', 'totalRequest'));
    }

    public function editMaintenanceStatus(Request $request)
    {
        $maintenanceId = $request->input('modal_id'); //from the hidden field of id
        $maintenance = Maintenance::find($maintenanceId);

        $maintenance->status = $request->input('modal_maintenance_status');

        $maintenance->update();
        return redirect()->route('maintenance')->with('status', 'Status updated!');
    }

    public function addMaintenanceRequest()
    {

    }
}
