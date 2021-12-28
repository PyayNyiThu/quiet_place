<?php

namespace App\Http\Controllers\backend;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $users = User::select('id', 'name', 'password', 'email', 'phone', 'address')->orderBy('id', 'desc')->get();

        return view('backend.users.index', compact('users'));
    }

    public function create() {
        return view('backend.users.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'password' => 'required|min:6|max:15',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'address' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        return redirect()->route('users.index')->with('create', 'Success created user!');
    }

    public function edit($id) {
        $user = User::select('id', 'name', 'password', 'email', 'phone', 'address')->findOrFail($id);

        return view('backend.users.edit', compact('user'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id ,
            'phone' => 'required|unique:users,phone,' . $id ,
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        return redirect()->route('users.index')->with('update', 'Success updated user!');
    }

    public function destroy($id) { 
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('delete', 'Success deleted user!');
    }
}
