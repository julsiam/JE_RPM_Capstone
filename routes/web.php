<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('./auth/login');
});

Auth::routes([ //for email verify
    'verify' => true
]);

Auth::routes();

Route::middleware(['auth', 'user-access:tenant'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('tenants.home')->middleware('verified');
    // Route::get('/search', [AnnouncementController::class, 'search_tenant'])->name('announcements.search_tenant');


    // Route::get('/profile', function () {
    //     return view('./tenants/profile');
    // });
});


Route::middleware(['auth', 'user-access:business_owner'])->group(function () {
    Route::get('/owner_dashboard', [HomeController::class, 'ownerDashboard'])->name('business_owner.owner_dashboard')->middleware('verified');
    Route::post('/add_announcement', [AnnouncementController::class, 'addAnnouncement'])->name('announcements.addAnnouncement');  //announcements is the table db name....addAnnouncement is the class in controller
    Route::get('/business_owner/announcement', [AnnouncementController::class, 'index'])->name('announcement');
    Route::get('/announcements/search', [AnnouncementController::class, 'search'])->name('announcements.search');
    Route::get('/tenants', [UserController::class, 'tenantsList'])->name('tenants');

    Route::get('/add_tenant_form', [UserController::class, 'showAddTenantForm'])->name('add_tenant_form');

    Route::get('/get_room_units', [UserController::class, 'getRoomUnits']);

    Route::get('/get_room_details', [UserController::class, 'getRoomDetails'])->name('get_room_details');

    Route::post('/add_tenant', [UserController::class, 'addTenant'])->name('tenant.addTenant');

    Route::get('/edit_tenant', function () { return view('./business_owner/edit_tenant'); });

    Route::get('/tenants-list', [UserController::class, 'getTenantsList']);

    Route::get('/get-tenant-details', [UserController::class, 'getTenantDetails']);

    //Route::get('/get-rental-details', [RentalController::class, 'getRentalDetails']);

    Route::post('/update-rental-details', [RentalController::class, 'editRentalDetails'])->name('tenant.editTenant');

    Route::get('/tenants_list', function () {
        return view('./business_owner/tenants_list');
    });


    // Route::get('/maintenance', function () {
    //     return view('./business_owner/maintenance');
    // });
    // Route::get('/maintenance_details', function () {
    //     return view('./business_owner/show_maintenance');
    // });
});
