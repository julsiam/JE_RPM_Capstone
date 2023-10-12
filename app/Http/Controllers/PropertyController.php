<?php

namespace App\Http\Controllers;

use App\Exports\PropertyExport;
use App\Models\Notification;
use App\Models\Property;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Test\Constraint\ResponseFormatSame;

class PropertyController extends Controller
{
    public function getProperties(Request $request)
    {
        $properties = Property::with('user')->get();

        $totalProperties = $properties->count();

        $occupiedProperties = Property::with('user')
            ->where('status', 'Occupied');

        $totalOccupiedProperties = $occupiedProperties->count();

        $availProperties = Property::with('user')
            ->where('status', 'Available');

        $totalAvailProperties = $availProperties->count();

        $currentDate = date('Y-m-d');

        $notifications = Notification::with('user')
            ->whereDate('created_at', $currentDate)
            ->orderBy('created_at', 'desc')
            ->get();

        $newNotification = Notification::with('rental.user')
            ->whereDate('created_at', $currentDate)
            ->where('seen', 0)
            ->count();


        return view('business_owner.property_list', compact('notifications', 'newNotification','properties', 'totalProperties', 'totalOccupiedProperties', 'totalAvailProperties'));
    }

    public function exportPropertyExcel()
    {
        return Excel::download(new PropertyExport, 'property_list.xlsx');
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'location' => ['required', 'string', 'max:255'],
            'room_unit' => ['required', 'string', 'max:255', 'unique:properties'],
            'inclusion' => ['required', 'string', 'max:255'],
            'room_rent' => ['required', 'numeric'],
            'status' => ['required'],
        ]);
    }


    public function addPropertyForm()
    {
        $currentDate = date('Y-m-d');

        $notifications = Notification::with('user')
            ->whereDate('created_at', $currentDate)
            ->orderBy('created_at', 'desc')
            ->get();

        $newNotification = Notification::with('rental.user')
            ->whereDate('created_at', $currentDate)
            ->where('seen', 0)
            ->count();


        return view('business_owner.add_property', compact('notifications', 'newNotification',));
    }


    public function addProperty(Request $request)
    {

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Property::create([
            'location' => $request->input('location'),
            'room_unit' => $request->input('room_unit'),
            'inclusion' => $request->input('inclusion'),
            'room_fee' => $request->input('room_rent'),
            'status' => $request->input('status')
        ]);

        return redirect()->route('properties')->with('message', 'Property Added Successfully!');
    }


    public function getPropertyDetails(Request $request)
    {
        $propertyId = $request->input('data-property-id');
        $property = Property::with('user')
            ->findOrFail($propertyId);

        return response()->json($property);
    }

    public function editProperty(Request $request)

    {
        $propertyId = $request->input('edit_property_id');
        $property = Property::find($propertyId);

        $validator = Validator::make($request->all(), [
            'edit_location' => ['required', 'string', 'max:255'],
            'edit_room_unit' => ['required', 'string', 'max:255', 'unique:properties,room_unit,' . $property->id],
            'edit_inclusions' => ['required', 'string', 'max:255'],
            'edit_room_fee' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $property->location = $request->input('edit_location');
        $property->room_unit = $request->input('edit_room_unit');
        $property->room_fee = $request->input('edit_room_fee');
        $property->inclusion = $request->input('edit_inclusions');

        $property->save();

        return redirect()->back()->with('success', 'Property Edited Succesfully');
    }
}
