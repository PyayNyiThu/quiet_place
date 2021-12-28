<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest:customer')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('customer');
    }

    public function showLoginForm()
    {        
        return view('auth.customer_login');
    }

    public function showLoginFormPrev()
    {
        if (!session()->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
        }

        return view('auth.customer_login_prev');
    }

    // public function login(Request $request) {
    //     $request->validate([
    //         'email' => 'required',
    //         'password' => 'required',
    //     ]);

    //     if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
    //         // return redirect()->intended('/room-page');
    //         // return back();
    //         return back()->withErrors(['old_password' => 'Old passowrd is not correct!'])->withInput();
    //     }
    //     return back()->withInput($request->only('email', 'password'));
    // }

    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect('/');
    }
}
