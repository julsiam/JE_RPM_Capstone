<?php

namespace App\Http\Controllers;

use App\Exports\TenantsExport;
use App\Models\File;
use App\Models\Notification;
use App\Models\Property;
use App\Models\Rental;
use App\Models\RentalHistory;
use App\Models\TenantProperty;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */


    //SHOW THE LOCATION DROPDOWN AS WELL

    public function showAddTenantForm()
    {
        $locations = $this->getLocationOptions();

        $currentDate = date('Y-m-d');

        $notifications = Notification::with('user')
            ->whereDate('created_at', $currentDate)
            ->orderBy('created_at', 'desc')
            ->get();

        $newNotification = Notification::with('rental.user')
            ->whereDate('created_at', $currentDate)
            ->where('seen', 0)
            ->count();


        return view('business_owner.add_tenant', compact('notifications', 'newNotification', 'locations'));
    }

    public function getLocationOptions()
    {
        $locations = Property::select('location')->distinct()->get();
        return $locations;
    }


    public function getRoomUnits(Request $request)
    {
        try {
            $location = $request->input('location');
            $roomUnits = Property::where('location', $location)
                ->where('status', 'Available') // Filter by status 0 (available)
                ->pluck('room_unit');
            return response()->json($roomUnits);
        } catch (\Exception $e) {
            Log::error('Error in getRoomUnits: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    public function getRoomDetails(Request $request)
    {
        $location = $request->input('location');
        $roomUnit = $request->input('room_unit');
        $roomDetails = Property::where('location', $location)
            ->where('room_unit', $roomUnit)
            ->first();

        return response()->json($roomDetails);
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'numeric', 'digits_between:10,11'], // change to numeric and add digits_between rule
            'age' => ['required', 'integer', 'min:2'], // add integer and min rule
            'birthdate' => ['required', 'date_format:Y-m-d', 'before_or_equal:today'], // add before_or_equal rule to ensure the birthdate is not in the future
            'gender' => ['string', 'in:Male,Female'], // add in rule to ensure the gender is one of the allowed values
            'address' => ['required', 'string', 'max:255'],
            'occupation' => ['required', 'string', 'max:255'],
            'work_address' => ['string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'type' => ['integer'], // add integer rule for type field

            // 'profilePictureInput' => 'image|mimes:jpeg,png,jpg,gif|max:2048',

            'water_bill' => ['required', 'numeric'],
            'electric_bill' => ['required', 'numeric'],
            'total_bill' => ['required', 'numeric'],
            'due_date' => ['required', 'date_format:Y-m-d', 'after_or_equal:today'],
            // 'due_date' => ['required', 'date_format:Y-m-d', 'after:today'],
            'status' => ['string', 'in:On Going,Not Yet Paid,Paid,Not Fully Paid'],


            'id_photo' => 'required|mimes:jpg,png|max:2048', // Validate id_photo file
            'contract_pdf' => 'required|mimes:pdf|max:2048',
        ]);
    }


    //ADD TENANT
    protected function addTenant(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $propertyId = $request->input('property_id');

        $property = Property::where('id', $propertyId)
            ->where('status', 'Available')
            ->first();

        if (!$property) {
            return redirect()->back()->with('error', 'Selected property is not available or does not exist.');
        }

        $defaultImagePath = 'image/default_photo.png'; // Provide the correct path to your default image
        $status = 'Active';

        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
            'age' => $request->input('age'),
            'birthdate' => $request->input('birthdate'),
            'gender' => $request->input('gender'),
            'address' => $request->input('address'),
            'occupation' => $request->input('occupation'),
            'work_address' => $request->input('work_address'),
            'type' => 0,
            'property_id' => $propertyId,
            'password' => Hash::make($request->input('password')),
            'status' => $status,

            'profile_picture' => $defaultImagePath,
        ]);

        $tenantPropertyHistory = TenantProperty::create([
            'user_id' => $user->id,
            'location' => $request->input('location'),
            'room_unit' => $request->input('room_unit'),
            'room_fee' => $request->input('room_fee_display'),
        ]);

        $rental = Rental::create([
            'user_id' => $user->id,
            'property_id' => $propertyId,
            'rent_started' => $request->input('rent_started'),
            'rent_from' => $request->input('rent_from'),
            'due_date' => $request->input('due_date'),
            'water_bill' => $request->input('water_bill'),
            'electric_bill' => $request->input('electric_bill'),
            'total_bill' => $request->input('total_bill'),
            'amount_paid' => $request->input('amount_paid'),
            'balance' => $request->input('balance'),
            'status' => $request->input('rentalStatus'),
        ]);

        RentalHistory::create([
            'rental_id' => $rental->id,
            'start_date' => $request->input('rent_from'),
            'end_date' => $request->input('due_date'),
            'total_rent' => $request->input('total_bill'),
            'initial_paid_amount' => $request->input('amount_paid'),
            'status' => $request->input('rentalStatus'),
        ]);

        $idPhotoFileType = $request->input('id_photo_file_type');
        $contractPdfFileType = $request->input('contract_file_type');

        $user_id = $user->id;

        if ($request->hasFile($idPhotoFileType)) {
            $idPhotoFile = $request->file($idPhotoFileType);

            $idPhotoModel = new File();
            $fileName = time() . '_' . $idPhotoFile->getClientOriginalName(); //time().'_'.$file->getClientOriginalName();
            $filePath = $idPhotoFile->storePublicly('public/id_photos');
            $filesize = $idPhotoFile->getSize();

            $idPhotoModel->user_id = $user_id;
            $idPhotoModel->name = $fileName;
            $idPhotoModel->type = $idPhotoFileType;
            $idPhotoModel->file_path = $filePath; // file_path
            $idPhotoModel->size = $filesize; //size

            $idPhotoModel->save();
        }

        if ($request->hasFile($contractPdfFileType)) {
            $contractPdfFile = $request->file($contractPdfFileType);

            $contractPdfModel = new File();
            $fileName = time() . '_' . $contractPdfFile->getClientOriginalName();
            $filePath = $contractPdfFile->storePublicly('public/contracts');
            $fileSize = $contractPdfFile->getSize();

            $contractPdfModel->user_id = $user_id;
            $contractPdfModel->name = $fileName;
            $contractPdfModel->type = $contractPdfFileType;
            $contractPdfModel->file_path = $filePath;
            $contractPdfModel->size = $fileSize;

            $contractPdfModel->save();
        }

        $property->user_id = $user->id;
        $property->status = 'Occupied';
        $property->save();

        return redirect()->route('tenants')->with('success', 'Tenant added successfully!');
    }



    //SHOW ALL TENANTS

    public function tenantsList()
    {
        $tenants = User::with('property')
            ->where('type', 0)
            ->where('status', 'Active')
            ->get();

        $currentDate = date('Y-m-d');

        $notifications = Notification::with('user')
            ->whereDate('created_at', $currentDate)
            ->orderBy('created_at', 'desc')
            ->get();

        $newNotification = Notification::with('rental.user')
            ->whereDate('created_at', $currentDate)
            ->where('seen', 0)
            ->count();


        // $totalTenants = User::where('type', 0)->count();

        return view('business_owner.tenants', compact('notifications', 'newNotification', 'tenants'));
    }

    //EXPORT TENANTS IN EXCEL FORMAT
    public function exportTenantExcel()
    {
        return Excel::download(new TenantsExport, 'tenants_list.xlsx');
    }



    //SHOW ALL TENANTS AND DISPLAY IN MODAL
    public function getTenantsList()
    {
        $tenants = User::where('type', 0)
            ->where('status', 'Active')
            ->select('id', 'first_name', 'last_name', 'email')
            ->get();

        return response()->json($tenants);
    }



    public function editTenantForm($id)
    {
        $currentDate = date('Y-m-d');

        $tenant = User::with(['rental.property', 'file' => function ($query) {
            $query->whereIn('type', ['id_photo', 'contract_pdf']);
        }])->findOrFail($id);


        $notifications = Notification::with('user')
            ->whereDate('created_at', $currentDate)
            ->orderBy('created_at', 'desc')
            ->get();

        $newNotification = Notification::with('rental.user')
            ->whereDate('created_at', $currentDate)
            ->where('seen', 0)
            ->count();


        return view('business_owner.edit_tenant', ['tenant' => $tenant], compact('tenant', 'notifications', 'newNotification',));
    }



    public function getTenantDetails(Request $request) //// DETAILS IN TENANT PROFILE IN EDIT RENTALS
    {
        $id = $request->input('id');

        $tenant = User::with(['rental.property', 'file' => function ($query) {
            $query->whereIn('type', ['id_photo', 'contract_pdf']);
        }])->findOrFail($id);

        // dd($tenant);

        return response()->json($tenant);
    }


    public function getTenant(Request $request) // DETAILS IN TENANT PROFILE IN TENANT LIST TABLE
    {
        $tenantId = $request->input('data-tenant-id');

        $tenant = User::with(['rental.property', 'rental.rentalHistory', 'file' => function ($query) {
            $query->whereIn('type', ['id_photo', 'contract_pdf']);
        }])->findOrFail($tenantId);

        return response()->json($tenant);
    }


    public function getInactiveTenant(Request $request) // DETAILS IN TENANT PROFILE IN TENANT LIST TABLE
    {
        $tenantId = $request->input('data-inactiveTenant-id');

        $tenant = User::with(['rental', 'rental.rentalHistory', 'file' => function ($query) {
            $query->whereIn('type', ['id_photo', 'contract_pdf']);
        }])->findOrFail($tenantId);

        dd($tenant);

        return response()->json($tenant);
    }




    public function deleteTenant(Request $request) //JUST UPDATE THE TENANT STATUS
    {
        // $tenant = User::find($request->tenant_delete_id);

        $tenantId = $request->input('tenant_delete_id'); // Retrieve the tenant ID from the request

        $tenant = User::find($tenantId);

        if ($tenant) {

            $tenant->status = 'Inactive';

            $property = $tenant->property;
            if ($property) {
                $property->resetForNewTenant();
            }

            $tenant->save();
            return redirect()->route('tenants')->with('delete', 'Deactivated Successfully!');
        }

        return redirect()->route('tenants')->with('error', 'Tenant not found!');
    }


    public function getInactiveTenants()
    {
        $inactiveTenants = User::with(['rental', 'tenantProperty'])
            ->where('type', 0)
            ->where('status', 'Inactive')
            // ->whereHas('rental', function ($query) {
            //     $query->where('status', 'Not Yet Paid');
            // })
            ->get();


        $currentDate = date('Y-m-d');

        $notifications = Notification::with('user')
            ->whereDate('created_at', $currentDate)
            ->orderBy('created_at', 'desc')
            ->get();

        $newNotification = Notification::with('rental.user')
            ->whereDate('created_at', $currentDate)
            ->where('seen', 0)
            ->count();

        return view('business_owner.inactive_tenants', compact('notifications', 'newNotification', 'inactiveTenants'));
    }





    public function getProfileDetails()
    {
        $user = Auth::user();

        return view('business_owner.profile', compact('user'));

        // return response()->json($user);
    }

    public function profilePage()
    {
        $tenants = User::with('property')
            ->where('type', 0)
            ->get();

        $currentDate = date('Y-m-d');

        $notifications = Notification::with('user')
            ->whereDate('created_at', $currentDate)
            ->orderBy('created_at', 'desc')
            ->get();

        $newNotification = Notification::with('rental.user')
            ->whereDate('created_at', $currentDate)
            ->where('seen', 0)
            ->count();

        return view('business_owner.profile', compact('notifications', 'newNotification'));
    }


    public function editProfile(Request $request)
    {
        // $user = Auth::user();
        $user = User::find(Auth::user()->id);

        $validator = Validator::make($request->all(), [
            'edit_firstname' => ['required', 'string', 'max:255'],
            'edit_lastname' => ['required', 'string', 'max:255'],
            'edit_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id], // Include the user's ID to exclude their current email
            'edit_phone' => ['required', 'numeric', 'digits_between:10,11'], // change to numeric and add digits_between rule
            'edit_birthdate' => ['required', 'date_format:Y-m-d', 'before_or_equal:today'], // add before_or_equal rule to ensure the birthdate is not in the future
            'edit_age' => ['required', 'integer', 'min:2'], // add integer and min rule
            'edit_address' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update the user's details based on the validated input
        $user->first_name = $request->input('edit_firstname');
        $user->last_name = $request->input('edit_lastname');
        $user->email = $request->input('edit_email');
        $user->phone_number = $request->input('edit_phone');
        $user->age = $request->input('edit_age');
        $user->birthdate = $request->input('edit_birthdate');
        $user->address = $request->input('edit_address');

        // Save the changes to the user's profile
        $user->save();

        return redirect()->back()->with('success', 'Profile details updated successfully!');
    }


    public function editProfilePicture(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $validator = Validator::make($request->all(), [
            'profilePictureInput' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the file types and size as needed
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('profilePictureInput')) {
            // $image = $request->file('profilePictureInput');
            // $imageName = time() . '_' . $image->getClientOriginalName();
            // $folder = 'profile';
            // $imagePath = $image->storeAs($folder, $imageName, 'public');


            $path = $request->file('profilePictureInput')
                ->storePublicly('public/profile');


            if ($user->profile_picture !== 'image/default_photo.png') {
                // Storage::delete('public/' . $user->profile_picture);
                Storage::disk('s3')->delete($user->profile_picture);
            }

            $user->profile_picture = $path;

            $user->save();

            return redirect()->back()->with('success', 'Profile picture updated successfully!');
        }

        return redirect()->back()->with('error', 'No image selected.');
    }



    //TENANT SIDE
    public function getTenantProfile()
    {
        $user = Auth::user();

        $profilePicture = File::where('user_id', $user->id)
            ->where('type', 'id_photo')
            ->first();

        return view('tenants.profile', compact('user', 'profilePicture'));
    }


    public function editTenantProfile(Request $request)
    {
        // $user = Auth::user();
        $user = User::find(Auth::user()->id);

        $validator = Validator::make($request->all(), [
            'edit_firstname' => ['required', 'string', 'max:255'],
            'edit_lastname' => ['required', 'string', 'max:255'],
            'edit_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id], // Include the user's ID to exclude their current email
            'edit_phone' => ['required', 'numeric', 'digits_between:10,11'], // change to numeric and add digits_between rule
            'edit_birthdate' => ['required', 'date_format:Y-m-d', 'before_or_equal:today'], // add before_or_equal rule to ensure the birthdate is not in the future
            'edit_age' => ['required', 'integer', 'min:2'], // add integer and min rule
            'edit_address' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update the user's details based on the validated input
        $user->first_name = $request->input('edit_firstname');
        $user->last_name = $request->input('edit_lastname');
        $user->email = $request->input('edit_email');
        $user->phone_number = $request->input('edit_phone');
        $user->age = $request->input('edit_age');
        $user->birthdate = $request->input('edit_birthdate');
        $user->address = $request->input('edit_address');

        // Save the changes to the user's profile
        $user->save();

        return redirect()->back()->with('success', 'Profile details updated successfully!');
    }
}
