<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoomtypeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PageController;

use App\Http\Controllers\HomeController;

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

//load home with public
Route::get('/',[HomeController::class,'home']);
Route::get('/service/{id}',[HomeController::class,'service_detail']);
Route::get('page/about-us',[PageController::class,'about_us']);
Route::get('page/contact-us',[PageController::class,'contact_us']);

// Admin Login
Route::get('admin/login',[AdminController::class,'login']);
Route::post('admin/login',[AdminController::class,'check_login']);
Route::get('admin/logout',[AdminController::class,'logout']);

// Admin Dashboard
Route::get('admin',[AdminController::class,'dashboard']);

// Banner Routes
Route::get('admin/banner/{id}/delete',[BannerController::class,'destroy']);
Route::resource('admin/banner',BannerController::class);

// RoomType Routes
Route::get('admin/roomtype/{id}/delete',[RoomtypeController::class,'destroy']);
Route::resource('admin/roomtype',RoomtypeController::class);

// Room
Route::get('admin/rooms/{id}/delete',[RoomController::class,'destroy']);
Route::resource('admin/rooms',RoomController::class);

// g
Route::get('admin/guest/{id}/delete',[Guest::class,'destroy']);
Route::resource('admin/guest',GuestController::class);
// Delete Image
Route::get('admin/roomtypeimage/delete/{id}',[RoomtypeController::class,'destroy_image']);

// Department
Route::get('admin/department/{id}/delete',[StaffDepartment::class,'destroy']);
Route::resource('admin/department',StaffDepartment::class);

// Staff Payment
Route::get('admin/staff/payments/{id}',[StaffController::class,'all_payments']);
Route::get('admin/staff/payment/{id}/add',[StaffController::class,'add_payment']);
Route::post('admin/staff/payment/{id}',[StaffController::class,'save_payment']);
Route::get('admin/staff/payment/{id}/{staff_id}/delete',[StaffController::class,'delete_payment']);
// Staff CRUD
Route::get('admin/staff/{id}/delete',[StaffController::class,'destroy']);
Route::resource('admin/staff',StaffController::class);


// Reservation
Route::get('admin/reservation/{id}/delete',[ReservationController::class,'destroy']);
Route::get('admin/reservation/available-rooms/{checkin_date}',[ReservationController::class,'available_rooms']);
Route::resource('admin/reservation',ReservationController::class);

Route::get('login',[GuestController::class,'login']);
Route::post('guest/login',[GuestController::class,'guest_login']);
Route::get('register',[GuestController::class,'register']);
Route::get('logout',[GuestController::class,'logout']);

Route::get('reservation',[ReservationController::class,'front_reservation']);
Route::get('reservation/success',[ReservationController::class,'reservation_payment_success']);
Route::get('reservation/fail',[ReservationController::class,'reservation_payment_fail']);

// Service CRUD
Route::get('admin/service/{id}/delete',[ServiceController::class,'destroy']);
Route::resource('admin/service',ServiceController::class);

// Testimonial
Route::get('guest/add-testimonial',[HomeController::class,'add_testimonial']);
Route::post('g/save-testimonial',[HomeController::class,'save_testimonial']);
Route::get('gdmin/testimonial/{id}/delete',[AdminController::class,'destroy_testimonial']);
Route::get('agmin/testimonials',[AdminController::class,'testimonials']);
Route::post('save-contactus',[PageController::class,'save_contactus']);



