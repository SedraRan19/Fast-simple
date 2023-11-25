<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthenticatedController,BookingController,CustomerController,VehicleController,CompanyController,DriverController,SettingController,UserController,RoleController,PlanController};
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

////////////AUTH//////////////////
Route::get('/', [AuthenticatedController::class,'index_login'])->name('login');
Route::post('/validation', [AuthenticatedController::class,'validation_login'])->name('validation_login');
Route::post('/register', [AuthenticatedController::class,'register'])->name('register');
Route::post('/register-company/{id}', [AuthenticatedController::class,'register_company'])->name('register_company');
Route::get('/logout', [AuthenticatedController::class,'disconnection'])->name('disconnection');
Route::get('/register', [AuthenticatedController::class,'index_register'])->name('register');
Route::get('/forgot-password', [AuthenticatedController::class,'index_forgot_password'])->name('forgot_password');
Route::get('/reset-password/{token}/{email}', [AuthenticatedController::class,'index_reset_password'])->name('reset_password');
Route::get('/confirm-password', [AuthenticatedController::class,'index_confirm_password'])->name('confirm_password');
Route::post('/verify-email', [AuthenticatedController::class,'verification_email'])->name('verification_email');
Route::post('/update-password', [AuthenticatedController::class,'update_password'])->name('update_password');


Route::middleware(['auth'])->group(function () {
/////////////BOOKING//////////////////////
Route::get('/create-booking', [BookingController::class,'index_create_booking'])->name('create_booking');
Route::get('/step-booking', [BookingController::class,'index_step_booking'])->name('step_booking');
Route::get('/confirm-booking', [BookingController::class,'index_confirm_booking'])->name('confirm_booking');
Route::get('/trips', [BookingController::class,'index_trip'])->name('trips');
Route::get('/manage/booking', [BookingController::class,'index_manage_booking'])->name('manage_booking');

Route::post('/step-one/booking', [BookingController::class,'store_step_one'])->name('store_step_one');
Route::post('/step-two/booking', [BookingController::class,'store_step_two'])->name('store_step_two');

Route::get('/trip-list', [BookingController::class,'trip_list'])->name('trip_list');
Route::get('/trip-upcoming-list', [BookingController::class,'trip_upcoming_list'])->name('trip_upcoming_list');
Route::get('/trip-history-list', [BookingController::class,'trip_history_list'])->name('trip_history_list');
Route::get('/search-trip', [BookingController::class,'search_trip'])->name('search_trip');
Route::get('/trip-paid-list', [BookingController::class,'trip_paid_list'])->name('trip_paid_list');
Route::get('/trip-unpaid-list', [BookingController::class,'trip_unpaid_list'])->name('trip_unpaid_list');

/////////////CUSTOMER///////////////////
Route::get('/customers', [CustomerController::class,'index_customer'])->name('customers');
Route::get('/customer-list', [CustomerController::class,'customer_list'])->name('customer_list');
Route::get('/customer-search', [CustomerController::class,'search_customer'])->name('search_customer');
Route::get('/delete/customer/{id}', [CustomerController::class,'delete_customer'])->name('delete_customer');
Route::get('/edit/customer/{id}', [CustomerController::class,'edit_customer'])->name('edit_customer');
Route::post('/update/customer/{id}', [CustomerController::class,'update_customer'])->name('update_customer');
Route::post('/store/customer', [CustomerController::class,'store_customer'])->name('store_customer');
Route::get('/create/customers', [CustomerController::class,'index_create_customer'])->name('create_customers');

Route::get('/passengers/{id}', [CustomerController::class,'index_passenger'])->name('passengers');
Route::get('/passenger-list/{id}', [CustomerController::class,'passenger_list'])->name('passenger_list');
Route::get('/passenger-search/{id}', [CustomerController::class,'search_passenger'])->name('search_passenger');
Route::get('/create/passenger/{id}', [CustomerController::class,'index_create_passenger'])->name('create_passenger');
Route::post('/passenger-store/{id}', [CustomerController::class,'store_passenger'])->name('store_passenger');

Route::get('/cards/{id}', [CustomerController::class,'index_card'])->name('cards');
Route::get('/create/card/{id}', [CustomerController::class,'index_create_card'])->name('create_card');
Route::post('/store/card/{id}', [CustomerController::class,'store_card'])->name('store_card');
Route::get('/delete/card/{id}', [CustomerController::class,'delete_card'])->name('delete_card');

////////////VEHICLE//////////////////
Route::get('/vehicles', [VehicleController::class,'index_vehicle'])->name('vehicles');
Route::post('/store/vehicle', [VehicleController::class,'store_vehicle'])->name('store_vehicle');
Route::post('/update/vehicle/{id}', [VehicleController::class,'update_vehicle'])->name('update_vehicle');
Route::get('/delete/vehicle/{id}', [VehicleController::class,'delete_vehicle'])->name('delete_vehicle');
Route::get('/create/vehicle', [VehicleController::class,'index_create_vehicle'])->name('create_vehicle');
Route::get('/edit/vehicle/{id}', [VehicleController::class,'index_edit_vehicle'])->name('edit_vehicle');
Route::get('/vehicle-list', [VehicleController::class,'vehicle_list'])->name('vehicle_list');
Route::get('/vehicle-search', [VehicleController::class,'search_vehicle'])->name('search_vehicle');

Route::get('/vehicle-categories', [VehicleController::class,'index_caterory_vehicle'])->name('vehicle_categories');
Route::get('/delete/vehicle-categories/{id}', [VehicleController::class,'delete_vehicle_category'])->name('delete_vehicle_category');
Route::get('/create/vehicle-category', [VehicleController::class,'index_create_caterory_vehicle'])->name('create_vehicle_categories');
Route::get('/edit/vehicle-category/{id}', [VehicleController::class,'index_edit_caterory_vehicle'])->name('edit_vehicle_category');
Route::post('/store/vehicle-category', [VehicleController::class,'store_vehicle_category'])->name('store_vehicle_category');
Route::post('/edit/vehicle-category/{id}', [VehicleController::class,'edit_vehicle_category'])->name('edit_vehicle_category');

///////////ACCOUNT///////////////
Route::get('/my-account', [CompanyController::class,'index_my_account'])->name('my_account');
Route::post('/update/my-account/{id}', [CompanyController::class,'update_company'])->name('update_company');

//////////DRIVER//////////////
Route::get('/drivers', [DriverController::class,'index_driver'])->name('drivers');
Route::get('/detail-driver/{id}', [DriverController::class,'index_detail_driver'])->name('detail_driver');
Route::get('/list-detail-driver/{id}', [DriverController::class,'list_detail_driver'])->name('list_detail_driver');
Route::get('/create/driver', [DriverController::class,'index_create_driver'])->name('create_driver');
Route::post('/store/driver-vehicle-category/{id}', [DriverController::class,'store_dvc'])->name('store_dvc');
Route::post('/edit/driver-vehicle-category', [DriverController::class,'edit_dvc'])->name('edit_dvc');
Route::post('/store/driver', [DriverController::class,'store_driver'])->name('store_driver');
Route::get('/edit/detail/{id}', [DriverController::class,'index_edit_driver'])->name('edit_driver');
Route::post('/update/detail/{id}', [DriverController::class,'update_driver'])->name('update_driver');
Route::get('/delete/driver-vehicle-category/{id}', [DriverController::class,'delete_dvc'])->name('delete_dvc');
Route::get('/delete/driver/{id}', [DriverController::class,'delete_driver'])->name('delete_driver');
Route::get('/list-drivers', [DriverController::class,'driver_list'])->name('driver_list');
Route::get('/search/list-drivers', [DriverController::class,'search_driver'])->name('search_driver');

///////////SETTING////////////
Route::get('/settings', [SettingController::class,'index_setting'])->name('settings');
Route::post('/create-update-setting', [SettingController::class,'updateOrCreate_setting'])->name('updateOrCreate_setting');

///////////USER/////////////
Route::get('/users', [UserController::class,'index_user'])->name('users');
Route::get('/edit-user/{id}', [UserController::class,'edit_user'])->name('edit_user');
Route::get('/delete-user/{id}', [UserController::class,'delete_user'])->name('delete_user');
Route::post('/update-user/{id}', [UserController::class,'update_user'])->name('update_user');
Route::get('/search/user', [UserController::class,'search_user'])->name('search_user');
Route::get('/user/list', [UserController::class,'user_list'])->name('user_list');
Route::get('/create/user', [UserController::class,'index_create_user'])->name('create_user');
Route::post('/store/user', [UserController::class,'store_user'])->name('store_user');

///////////ROLE////////////
Route::get('/roles', [RoleController::class,'index_role'])->name('roles');
Route::get('/role-list', [RoleController::class,'role_list'])->name('role_list');
Route::get('/search-role', [RoleController::class,'search_role'])->name('search_role');
Route::get('/manage/role', [RoleController::class,'index_manage_role'])->name('manage_role');
Route::get('/edit-role/{id}', [RoleController::class,'edit_role'])->name('edit_role');
Route::post('/update-role/{id}', [RoleController::class,'update_role'])->name('update_role');
Route::post('/store-role', [RoleController::class,'store_role'])->name('store_role');
Route::get('/delete-role/{id}', [RoleController::class,'delete_role'])->name('delete_role');


//////////PlAM////////////
Route::get('/plans', [PlanController::class,'index_plan'])->name('plans');
Route::get('/manage-plans', [PlanController::class,'index_manage_plan'])->name('manage_plan');
Route::get('/create/plan', [PlanController::class,'index_create_plan'])->name('create_plan');
Route::post('/store-plan', [PlanController::class,'store_plan'])->name('store_plan');
Route::get('/delete-plan/{id}', [PlanController::class,'delete_plan'])->name('delete_plan');
Route::get('/edit-plan/{id}', [PlanController::class,'edit_plan'])->name('edit_plan');
Route::post('/update-plan/{id}', [PlanController::class,'update_plan'])->name('update_plan');

});

