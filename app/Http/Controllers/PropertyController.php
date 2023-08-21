<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class PropertyController extends Controller
{
    public function getProperties(Request $request)
    {
       $properties = Property::with('user')->get();

        $totalProperties = $properties->count();

       return view ('business_owner.property_list', compact('properties', "totalProperties"));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'location' => ['required', 'string', 'max:255'],
            'room_unit' => ['required', 'string', 'max:255','unique:properties'],
            'inclusion' => ['required', 'string', 'max:255'],
            'room_rent' => ['required', 'numeric'],
            'status' => ['required'],
        ]);
    }

    public function addProperty(Request $request){

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Property::create([
            'location' => $request->input('location'),
            'room_unit'=> $request->input('room_unit'),
            'inclusion'=>$request->input('inclusion'),
            'room_fee'=> $request->input('room_rent'),
            'status'=>$request->input('status')
        ]);

        return redirect()->route('properties')->with('success', 'Property Added Successfully!');
    }
}
