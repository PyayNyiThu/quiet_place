<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;

class IsBanned
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
        if (auth()->check() && auth()->user()->status != 'active') {

            if (auth()->user()->status == 'banned') {
                $message = 'Your account has been banned. Please contact administrator!';
            }

            if (auth()->user()->status == 'locked') {
                $message = 'Your account has been locked. Please contact administrator!';
            }

            // if (now()->lessThan(auth()->user()->banned_till)) {
            //     $banned_days = now()->diffInDays(auth()->user()->banned_till) + 1;
            //     $message = 'Your account has been suspended for ' . $banned_days . ' ' . Str::plural('day', $banned_days);
            // }

            auth()->logout();

            return redirect()->route('login')->withErrors(['email' => $message]);
        }

        if (auth()->guard('customer')->check() && auth()->guard('customer')->user()->status != 'active') {
            // dd(auth()->guard('customer')->user()->status);die();
            if (auth()->guard('customer')->user()->status == 'banned') {
                $message = 'Your account has been banned. Please contact administrator!';
            }

            if (auth()->guard('customer')->user()->status == 'locked') {
                $message = 'Your account has been locked. Please contact administrator!';
            }

            // if (now()->lessThan(auth()->user()->banned_till)) {
            //     $banned_days = now()->diffInDays(auth()->user()->banned_till) + 1;
            //     $message = 'Your account has been suspended for ' . $banned_days . ' ' . Str::plural('day', $banned_days);
            // }
            
            auth()->guard('customer')->logout();

            return back()->withErrors(['email' => $message]);
        }

        return $next($request);
    }
}
