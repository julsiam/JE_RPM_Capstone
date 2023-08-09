<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function getMaintenances(Request $request){

        $maintenance = Maintenance::with('user')->get();
        $totalMaintenance = $maintenance->count();

        return view ('business_owner.maintenance', compact('maintenance', 'totalMaintenance'));

    }
}
