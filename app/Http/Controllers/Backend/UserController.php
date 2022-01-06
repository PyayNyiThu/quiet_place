<?php

namespace App\Http\Controllers\backend;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index() {
        $users = User::select('id', 'name', 'password', 'email', 'phone', 'address', 'deleted_at')->withTrashed()->orderBy('id', 'desc')->get();

        return view('backend.users.index', compact('users'));
    }

    public function create() {
        $roles = Role::pluck('name','name')->all();

        return view('backend.users.create', compact('roles'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'password' => 'required|min:6|max:15',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'address' => 'required',
            'roles' => 'required'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->assignRole($request->roles);
        $user->save();

        return redirect()->route('users.index')->with('create', 'Success created user!');
    }

    public function edit($id) {
        $user = User::select('id', 'name', 'password', 'email', 'phone', 'address')->findOrFail($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('backend.users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id ,
            'phone' => 'required|unique:users,phone,' . $id ,
            'address' => 'required',
            'roles' => 'required'
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->roles);

        return redirect()->route('users.index')->with('update', 'Success updated user!');
    }

    public function destroy($id) { 
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('delete', 'Success deleted user!');
    }

    public function restore($id) {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('users.index')->with('restore', 'Success restored user!');
    }
}
