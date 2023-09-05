<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MaintenanceController extends Controller
{
    //FOR TENANTS

    public function validator(array $data)
    {
        return Validator::make($data, [
            'request_type' => ['required', 'string'],
            'request_priority' => ['string', 'in:High, Medium,Low'],
            'request_description' => ['required', 'string']
        ]);
    }


    public function addMaintenanceRequest(Request $request) //add maintenance for tenant
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = Auth::user();

        $maintenance = Maintenance::create([
            'user_id' => $user->id,
            'date_requested' => $request->input('hidden_request_date_requested'),
            'request_type' => $request->input('request_type'),
            'priority' => $request->input('request_priority'),
            'description' => $request->input('request_description'),
            'status' => 'Pending',
        ]);

        // dd($maintenance);

        return redirect()->route('my_request');
    }


    public function getMyMaintenance() //my own request display in table
    {
        $user = Auth::user();
        $maintenanceRequests = $user->maintenance;
        $totalRequests = $maintenanceRequests->count();

        return view('tenants.maintenance', compact('maintenanceRequests', 'totalRequests'));
    }

    public function getRequestDetails(Request $request) //my own request display in modal, one by one
    {
        $requestId = $request->input('data-request-id');
        $maintenance = Maintenance::with('user.property')->findOrFail($requestId);

        return response()->json($maintenance);
    }


    //FOR BUSINESS OWNER

    public function getMaintenances(Request $request) // get all maintenances for business owner
    {

        $maintenance = Maintenance::orderBy('date_requested', 'asc')->with('user')->get(); //get ALL
        $totalMaintenance = $maintenance->count();

        return view('business_owner.maintenance', compact('maintenance', 'totalMaintenance'));
    }

    public function getMaintenance(Request $request) //get ONE for business owner ig click sa specific row
    {
        $maintenanceId = $request->input('data-maintenance-id'); //from the ID built sa button
        $maintenance = Maintenance::with('user.property')->findOrFail($maintenanceId);

        return response()->json($maintenance);
    }

    public function editMaintenanceStatus(Request $request) //for business owner STATUS UPDATE
    {
        $maintenanceId = $request->input('modal_id'); //from the hidden field of id
        $maintenance = Maintenance::find($maintenanceId);

        $maintenance->status = $request->input('modal_maintenance_status');

        $maintenance->update();
        return redirect()->route('maintenance')->with('status', 'Status updated!');
    }
}
