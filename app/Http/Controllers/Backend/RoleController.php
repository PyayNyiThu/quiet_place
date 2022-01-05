<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function __construct() {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index() {
        $roles = Role::all();

        return view('backend.roles.index', compact('roles'));
    }

    public function create() {
        $permission = Permission::get();

        return view('backend.roles.create', compact('permission'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permission);

        return redirect()->route('roles.index')->with('create', 'Success created role!');
    }

    public function show($id) {
        $role = Role::findOrFail($id);
        $role_permissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();
    
        return view('backend.roles.show',compact('role','role_permissions'));
    }

    public function edit($id) {
        $role = Role::find($id);
        $permission = Permission::get();
        $role_permissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('backend.roles.edit', compact('role', 'permission', 'role_permissions'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();
    
        $role->syncPermissions($request->permission);

        return redirect()->route('roles.index')->with('update', 'Success updated role!');
    }

    public function destroy($id) {
        DB::table("roles")->where('id',$id)->delete();

        return redirect()->route('roles.index')->with('delete', 'Success deleted role!');
    }
    
}
