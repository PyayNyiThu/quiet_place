<?php

namespace App\Http\Controllers\Frontend;

use App\Room;
use App\Booking;
use App\Service;
use App\RoomType;
use App\Township;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index() {
        $townships = Township::select('id', 'name')->get();
        $room_type = RoomType::select('id', 'name')->get();

        return view('frontend.index', compact('townships', 'room_type'));
    }

    public function contact() {
        return view('frontend.contact');
    }

    public function roomPage(Request $request) {
        $township = $request->township;
        $room_type = $request->room_type;
        $booking_date = $request->booking_date;
        
        $townships = Township::select('id', 'name')->get();
        $room_types = RoomType::select('id', 'name')->get();

        $rooms = Room::select('id', 'price', 'photo', 'description', 'roomtype_id', 'township_id', 'size', 'capacity')
        ->with(['roomtype:id,name', 'township:id,name'])
        ->where(function ($query) use ($township, $room_type) {
            if("" != $township) {
                $query->where('township_id', $township);
            }

            if("" != $room_type) {
                $query->where('roomtype_id', $room_type);
            }
        })->whereHas('bookings', function ($query) use ($booking_date){
            $query->where('booking_date', $booking_date);
        }, '<', 3)->get();

        return view('frontend.room_page', compact('townships', 'room_types', 'rooms', 'township', 'room_type', 'booking_date'));
    }

    public function roomPageDetail(Request $request, $id) {
        $room = Room::select('id', 'price', 'photo', 'description', 'roomtype_id', 'township_id', 'size', 'capacity')
                ->with(['roomtype:id,name', 'township:id,name'])
                ->findOrFail($id);

        $booking_date = $request->booking_date;
    
        return view('frontend.room_page_detail', compact('room','booking_date'));
    }

    public function customerBookingList($id) {
        $booking_list = Booking::select('id', 'booking_no', 'customer_id', 'room_id', 'booking_date', 'time', 'status')
        ->with(['room:id,price,photo,description,roomtype_id,township_id,size,capacity',
                'room.roomtype:id,name',
                'room.township:id,name'])
        ->where('customer_id', $id)->get();

        return view('frontend.customer_booking_list', compact('booking_list'));
    }

    public function customerBookingDetail($customer_id, $booking_id) {
        $booking = Booking::select('id', 'booking_no', 'customer_id', 'room_id', 'booking_date', 'time', 'status')
        ->with(['room:id,price,photo,description,roomtype_id,township_id,size,capacity',
                'room.roomtype:id,name',
                'room.township:id,name'])
        ->where('customer_id', $customer_id)->findOrFail($booking_id);
    
        return view('frontend.customer_booking_detail', compact('booking'));
    }
}
