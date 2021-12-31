<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('customer/login', 'Auth\CustomerLoginController@showLoginForm');

Route::get('customer/login-prev', 'Auth\CustomerLoginController@showLoginFormPrev');

Route::post('customer/login', 'Auth\CustomerLoginController@login')->name('customer.login');

Route::post('customer/logout', 'Auth\CustomerLoginController@logout')->name('customer.logout');

Route::get('customer/register', 'Auth\CustomerRegisterController@showRegistrationForm');

Route::get('customer/register-prev', 'Auth\CustomerRegisterController@showRegistrationFormPrev');

Route::post('customer/register', 'Auth\CustomerRegisterController@register')->name('customer.register');

Route::post('customer/register-prev', 'Auth\CustomerRegisterController@registerRedirectPrev')->name('customer.register-prev');

// Frontend Route

Route::namespace('Frontend')->group(function() {
    
    Route::get('/', 'PageController@index')->name('home');

    Route::get('/contact', 'PageController@contact');

    Route::get('/room-page', 'PageController@roomPage')->name('frontend.room_page');

    Route::post('/room-page', 'PageController@roomPage')->name('frontend.room_page');

    Route::get('/room-page/{id}', 'PageController@roomPageDetail')->name('frontend.room_page_detail')->middleware('check_url');

    Route::get('/customer-booking-list/{id}', 'PageController@customerBookingList')->name('frontend.customer_booking_list')->middleware('auth:customer');

    Route::get('/customer-booking/{customer_id}/detail/{booking_id}', 'PageController@customerBookingDetail')->name('frontend.customer_booking_detail')->middleware('auth:customer');
});


//getBookingid for ajax
Route::get('/getBookingId/{id}/{date}','Backend\BookingController@getBookingId')->name('getBookingByid');

Route::post('/frontendBooking','Backend\BookingController@frontendBooking')->name('frontendBooking')->middleware('check_time');

// Backend route

Auth::routes();

Route::prefix('admin')->namespace('Backend')->middleware('auth')->group(function() {
    
    Route::resource('/rooms', 'RoomController');

    Route::resource('/room-types', 'RoomTypeController');
    
    Route::resource('/services', 'ServiceController');

    Route::resource('/townships', 'TownshipController');

    Route::resource('/bookings', 'BookingController');

    Route::resource('/customers', 'CustomerController');

    Route::resource('/users', 'UserController');

    Route::get('/change-status/{id}', 'BookingController@changeStatus');

    Route::get('/new-booking-list', 'BookingController@newBookingList');
});
