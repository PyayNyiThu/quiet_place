<?php

namespace App\Http\Controllers\Backend;

use App\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;
use App\Room;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function __construct() {
        $this->middleware('permission:booking-list|booking-create|booking-edit|booking-delete', ['only' => ['index','store']]);
        $this->middleware('permission:booking-create', ['only' => ['create','store']]);
        $this->middleware('permission:booking-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:booking-delete', ['only' => ['destroy']]);
    }

    public function index() {
        $bookings = Booking::select('id', 'booking_no', 'customer_id', 'room_id', 'booking_date', 'time', 'status', 'deleted_at')
        ->withTrashed()
        ->with(['customer:id,name,email,phone',
                'room:id,price,photo,roomtype_id,township_id,size,capacity',
                'room.township:id,name',
                'room.roomtype:id,name'])
        ->orderBy('id', 'desc')
        ->get();

        return view('backend.bookings.index', compact('bookings'));
    }

    public function create() {
        $customer = Customer::select('id', 'name')->get();
        $room = Room::select('id', 'price', 'photo', 'description', 'roomtype_id', 'township_id', 'size', 'capacity')->get();

        return view('backend.bookings.create', compact('customer', 'room'));
    }

    public function store(Request $request) {
        //
    }

    public function show($id) {
        $booking = Booking::select('id', 'booking_no', 'customer_id', 'room_id', 'booking_date', 'time', 'status')->findOrFail($id);

        return view('backend.bookings.detail', compact('booking'));
    }

    public function frontendBooking(Request $request) {
        $authuser_booking_count = Booking::whereDate('created_at', date('Y-m-d'))->where('customer_id', Auth::guard('customer')->user()->id)->count();

        if (10 > $authuser_booking_count) {
            $authuser_booking_count = '0' . ($authuser_booking_count + 1);
        }
        $booking_no = date('Ymd') . Auth::guard('customer')->user()->id . $authuser_booking_count;

        $booking = new Booking;
        $booking->booking_no = $booking_no;
        $booking->customer_id = $request->customer_id;
        $booking->room_id = $request->room_id;
        $booking->booking_date = $request->booking_date;
        $booking->time = $request->booking_time;
        $booking->status = 1;
        $booking->save();

        return redirect()->route('home')->with('create', 'Success created booking!');
    }

    public function edit($id) {
        $booking = Booking::findOrFail($id);
        $customer = Customer::select('id', 'name', 'phone')->get();
        $room = Room::select('id', 'price', 'photo', 'description', 'roomtype_id', 'township_id', 'size', 'capacity')->get();

        return view('backend.bookings.edit', compact('booking', 'customer', 'room'));
    }

    public function update(Request $request, $id) {
        $booking = Booking::findOrFail($id);
        $booking->customer_id = $request->customer_id;
        $booking->room_id = $request->room_id;
        $booking->booking_date = $request->booking_date;
        $booking->time = $request->booking_time;
        // $booking->status = 1;
        $booking->save();

        return redirect()->route('bookings.index')->with('update', 'Success updated booking!');
    }

    public function destroy($id) { 
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('bookings.index')->with('delete', 'Success deleted booking!');
    }

    public function restore($id) {
        $booking = Booking::onlyTrashed()->findOrFail($id);
        $booking->restore();

        return redirect()->route('bookings.index')->with('restore', 'Success restored booking!');
    }

    public function changeStatus($id) {
        $booking = Booking::findOrFail($id);
        $booking->status = 0;
        $booking->save();

        return back();
    }

    public function newBookingList() {
        $bookings = Booking::where('status', 1)->get();

        return view('backend.bookings.new-booking-list', compact('bookings'));
    }

    //getBookingByid for ajax
    public function getBookingId($id, $date) {
        $booking = Booking::select('id', 'booking_date', 'time')->where('room_id', $id)->whereDate('booking_date', $date)->get();

        return $booking;
    }
}
