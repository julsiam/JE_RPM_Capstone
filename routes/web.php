<?php

use App\Http\Controllers\AnnouncementController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaintenanceController;
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

Route::middleware(['auth', 'user-access:tenant', 'verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'getAnnouncements'])->name('tenants.home');

    // Route::get('/search', [AnnouncementController::class, 'search_tenant'])->name('announcements.search_tenant');

    Route::get('/request', [MaintenanceController::class, 'getMyMaintenance'])->name('my_request');

    Route::get('/getReqDetails', [MaintenanceController::class, 'getRequestDetails']); //modal details

    Route::post('/submit-request', [MaintenanceController::class, 'addMaintenanceRequest'])->name('maintenance.submit');

    // Route::get('/showAddRequestModal', [MaintenanceController::class, 'showAddRequestModal'])->name('maintenance.showAddRequestModal');


    Route::get('/rental', function () {
        return view('./tenants/rental');
    });
});


Route::middleware(['auth', 'user-access:business_owner'])->group(function () {
    Route::get('/owner_dashboard', [HomeController::class, 'ownerDashboard'])->name('business_owner.owner_dashboard');

    Route::get('/get_announcement_locations', [AnnouncementController::class, 'getAnnouncementLocations']);

    Route::post('/add_announcement', [AnnouncementController::class, 'addAnnouncement'])->name('announcement.addAnnouncement');

    Route::get('/announcements', [AnnouncementController::class, 'getAnnouncements'])->name('announcements');

    // Route::delete('/announcements/{announcement}', [AnnouncementController::class, 'deleteAnnouncement'])->name('announcement.delete');
    Route::post('/delete_announcement', [AnnouncementController::class, 'deleteAnnouncement'])->name('announcement.delete');

    Route::get('/announcements/search', [AnnouncementController::class, 'search'])->name('announcements.search');

    Route::get('/add_tenant_form', [UserController::class, 'showAddTenantForm'])->name('add_tenant_form');

    Route::get('/get_room_units', [UserController::class, 'getRoomUnits']);

    Route::get('/get_room_details', [UserController::class, 'getRoomDetails'])->name('get_room_details');

    Route::post('/add_tenant', [UserController::class, 'addTenant'])->name('tenant.addTenant');

    Route::get('/edit_tenant', function () {
        return view('./business_owner/edit_tenant');
    });

    Route::get('/tenants', [UserController::class, 'tenantsList'])->name('tenants'); //SHOW ALL TENANTS

    //Route::get('/tenants_location', [UserController::class, 'sortByLocation']); //SHOW ALL TENANTS

    Route::get('/tenants-list', [UserController::class, 'getTenantsList']); //MODAL LIST OF TENANTS IN EDIT TENANT

    Route::get('/get-tenant-details', [UserController::class, 'getTenantDetails']); //INDIVIDUAL

    Route::post('/update-rental-details', [RentalController::class, 'editRentalDetails'])->name('tenant.editTenant');

    Route::get('/add_property_form', function () {
        return view('./business_owner/add_property');
    });

    Route::get('/properties', [PropertyController::class, 'getProperties'])->name('properties');

    Route::post('/add_property', [PropertyController::class, 'addProperty'])->name('property.addProperty');

    Route::get('/maintenance', [MaintenanceController::class, 'getMaintenances'])->name('maintenance');

    Route::get('/getMaintenanceDetails', [MaintenanceController::class, 'getMaintenance']);

    Route::post('/update-maintenance-status', [MaintenanceController::class, 'editMaintenanceStatus'])->name('maintenance.editMaintenanceStatus');

    // Route::get('/maintenance', function () {
    //     return view('./business_owner/maintenance');
    // });
    // Route::get('/maintenance_details', function () {
    //     return view('./business_owner/show_maintenance');
    // });
});
