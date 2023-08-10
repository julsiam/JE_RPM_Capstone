<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function getMaintenances(Request $request){

        $maintenance = Maintenance::with('user')->get();//get ALL
        $totalMaintenance = $maintenance->count();

        return view ('business_owner.maintenance', compact('maintenance', 'totalMaintenance'));

    }

    public function getMaintenance(Request $request) //get ONE
    {
        $maintenanceId = $request->input('data-maintenance-id');
        $maintenance = Maintenance::with('user.property')->findOrFail($maintenanceId);

        return response()->json($maintenance);
    }

    public function editMaintenanceStatus(Request $request)
    {
        $maintenanceId = $request->input('data-maintenance-id');
        $maintenance = Maintenance::find($maintenanceId);

        $maintenance->status = $request->input('modal_maintenance_status');

        $maintenance->save();
        return redirect()->route('maintenance');
    }
}
