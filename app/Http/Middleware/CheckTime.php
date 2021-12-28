<?php

namespace App\Http\Middleware;

use App\Booking;
use Closure;

class CheckTime
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $booking_date = $request->booking_date;
        $booking_time = $request->booking_time;
        $room_id = $request->room_id;

        $check_time = Booking::where('room_id', $room_id)->where('time', $booking_time)->whereDate('booking_date', $booking_date)->count();

        if(1 <= $check_time) {
            return redirect()->route('frontend.room_page')->with('error', 'Sorry your booking is not successful. Please try again!');
        }
        return $next($request);
    }
}
