<?php

namespace App\Http\Middleware;

use App\Booking;
use Closure;

class CheckUrl
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
        $id = $request->id;

        $check_url = Booking::where('room_id', $id)->whereDate('booking_date', $booking_date)->count();

        if(2 < $check_url) {
            return redirect('/room-page');
        }

        return $next($request);
    }
}
