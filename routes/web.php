<?php

use App\Http\Controllers\AnnouncementController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\SmsController;
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
    return view ('welcome');
});

// Route::get('/mail', function () {
//     return view ('email.receipt_mail');
// });


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

    Route::get('/get_locs', [HomeController::class, 'getLocs']);

    Route::get('/owner_dashboard', [HomeController::class, 'ownerDashboard'])->name('business_owner.owner_dashboard');

    Route::get('/get_tenant_count_by_location', [HomeController::class, 'getTenantCountByLocation']);

    Route::get('/get_property_count_by_location', [HomeController::class, 'getPropertiesCountByLocation']);

    Route::get('/get_total_income_per_month', [HomeController::class, 'getTotalIncome']);

    Route::get('/get_announcement_locations', [AnnouncementController::class, 'getAnnouncementLocations']);

    Route::post('/add_announcement', [AnnouncementController::class, 'addAnnouncement'])->name('announcement.addAnnouncement');

    Route::get('/announcements', [AnnouncementController::class, 'getAnnouncements'])->name('announcements');

    Route::get('/getAnnouncementDetails', [AnnouncementController::class, 'getAnnouncement']);

    Route::post('/editAnnouncement', [AnnouncementController::class, 'editAnnouncement'])->name('editAnnouncement');



    Route::post('/delete_announcement', [AnnouncementController::class, 'deleteAnnouncement'])->name('announcement.delete');

    Route::get('/announcements/search', [AnnouncementController::class, 'search'])->name('announcements.search');

    Route::get('/add_tenant_form', [UserController::class, 'showAddTenantForm'])->name('add_tenant_form');

    Route::get('/get_room_units', [UserController::class, 'getRoomUnits']);

    Route::get('/get_room_details', [UserController::class, 'getRoomDetails'])->name('get_room_details');

    Route::post('/add_tenant', [UserController::class, 'addTenant'])->name('tenant.addTenant');

    Route::get('/edit_tenant/{id}', [UserController::class, 'editTenantForm']);

    Route::get('/tenants', [UserController::class, 'tenantsList'])->name('tenants'); //SHOW ALL TENANTS

    Route::post('/delete_tenant', [UserController::class, 'deleteTenant'])->name('tenant.delete_tenant'); //update tenant status




    Route::get('/tenants_export', [UserController::class, 'exportTenantExcel'])->name('tenants_export'); //SHOW ALL TENANTS


    Route::get('/tenants-list', [UserController::class, 'getTenantsList']); //MODAL LIST OF TENANTS IN EDIT TENANT

    Route::get('/get-tenant-details', [UserController::class, 'getTenantDetails']); //INDIVIDUAL IN EDIT RENTAL

    Route::get('/tenant-details', [UserController::class, 'getTenant']);

    Route::get('/inactive-tenant-details', [UserController::class, 'getInactiveTenant']);


    Route::get('/inactive-tenant', [UserController::class, 'getInactiveTenants'])->name('inactive-tenants');



    Route::post('/update-rental-details', [RentalController::class, 'editRentalDetails'])->name('tenant.editTenant');

    Route::get('/add_property_form', [PropertyController::class, 'addPropertyForm']);


    Route::post('/add_property', [PropertyController::class, 'addProperty'])->name('property.addProperty');

    Route::get('/properties', [PropertyController::class, 'getProperties'])->name('properties');

    Route::get('/get_property_details', [PropertyController::class, 'getPropertyDetails']);

    Route::post('/edit_property', [PropertyController::class, 'editProperty'])->name('edit_property');

    Route::get('/properties_export', [PropertyController::class, 'exportPropertyExcel'])->name('properties_export'); //SHOW ALL TENANTS


    Route::get('/maintenance', [MaintenanceController::class, 'getMaintenances'])->name('maintenance');

    Route::get('/getMaintenanceDetails', [MaintenanceController::class, 'getMaintenance']);

    Route::post('/update-maintenance-status', [MaintenanceController::class, 'editMaintenanceStatus'])->name('maintenance.editMaintenanceStatus');


    //TO GET THE LOCATIONS FOR PAYMENT RECORDS IN JSON FORMAT AND PASS IT TO AJAX
    Route::get('/get_locations', [RentalController::class, 'getLocations']);

    //TO DISPLAY LOCATIONS IN VIEW
    Route::get('/paid_records', [RentalController::class, 'paidRecord'])->name('paid_records');

    //TO GET THE PAID RECORDS WITH THE FILTERED DETAILS
    Route::get('/get_paid_records', [RentalController::class, 'getPaidRecords']);

    //TO DISPLAY LOCATIONS IN VIEW
    Route::get('/notyetpaid_records', [RentalController::class, 'notYetPaidRecord'])->name('notyetpaid_records');

    //TO GET THE NOT PAID RECORDS WITH THE FILTERED DETAILS
    Route::get('/get_notpaid_records', [RentalController::class, 'getNotPaidRecords']);

    //TO DISPLAY LOCATIONS IN VIEW
    Route::get('/notfullypaid_reports', [RentalController::class, 'notFullyPaidReport'])->name('notfullypaid_reports');

    //TO GET NOT FULLY PAID RECORDS
    Route::get('/get_notfullypaid_reports', [RentalController::class, 'getNotFullyPaidRecords'])->name('get_notfullypaid_reports');

    //TO DISPLAY LOCATIONS IN VIEW
    Route::get('/paid_reports', [RentalController::class, 'paidReport'])->name('paid_reports');

    //TO DISPLAY LOCATIONS IN VIEW
    Route::get('/get_paid_reports', [RentalController::class, 'getPaidReports'])->name('get_paid_reports');


    //TO DISPLAY LOCATIONS IN VIEW
    Route::get('/unpaid_reports', [RentalController::class, 'unPaidReport'])->name('unpaid_reports');

    //TO DISPLAY LOCATIONS IN VIEW
    Route::get('/get_unpaid_reports', [RentalController::class, 'getUnPaidReports'])->name('get_unpaid_reports');

    // Route::get('/calendar', [RentalController::class, 'getTodaysDue'])->name('calendar');

    Route::get('/due_date', [RentalController::class, 'getEvents'])->name('due_date');


    Route::get('/profile', [UserController::class, 'profilePage']);

    Route::get('/get_profile_details', [UserController::class, 'getProfileDetails']);

    Route::post('/edit_profile_pic', [UserController::class, 'editProfilePicture'])->name('edit_profile_pic');

    Route::post('/edit_profile', [UserController::class, 'editProfile'])->name('edit_profile');


    Route::get('/total_notification', [NotificationController::class, 'totalNotification']);

    // Route::get('/sms', [SmsController::class, 'sendsms']);

    Route::get('/due-email', [MailController::class, 'sendDueDateEmail']);

    // To show the line graphs
    Route::get('/show-line-chart', [YourController::class, 'showLineChart']);

});
