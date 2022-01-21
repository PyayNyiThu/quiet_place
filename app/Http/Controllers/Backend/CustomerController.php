<?php

namespace App\Http\Controllers\Backend;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function __construct() {
        $this->middleware('permission:customer-list|customer-create|customer-edit|customer-delete', ['only' => ['index','store']]);
        $this->middleware('permission:customer-create', ['only' => ['create','store']]);
        $this->middleware('permission:customer-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:customer-delete', ['only' => ['destroy']]);
    }

    public function index() {
        if("Admin" != auth()->user()->roles[0]->name) {
            $customers = Customer::select('id', 'name', 'password', 'email', 'phone', 'address', 'status', 'deleted_at')->orderBy('id', 'desc')->get();
        } else {
            $customers = Customer::select('id', 'name', 'password', 'email', 'phone', 'address', 'status', 'deleted_at')->orderBy('id', 'desc')->withTrashed()->get();
        }

        return view('backend.customers.index', compact('customers'));
    }

    public function create() {
        return view('backend.customers.form');
    }

    public function show($id) {
        $customer = Customer::select('id', 'name', 'password', 'email', 'phone', 'address')->findOrFail($id);

        return view('backend.customers.detail', compact('customer'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'password' => 'required|min:6|max:15',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|unique:customers,phone',
            'address' => 'required',
        ]);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->password = Hash::make($request->password);
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->status = $request->status;
        $customer->save();

        return redirect()->route('customers.index')->with('create', 'Success created customer!');
    }

    public function edit($id) {
        $customer = Customer::select('id', 'name', 'password', 'email', 'phone', 'address', 'status')->findOrFail($id);

        return view('backend.customers.form', compact('customer'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email,' . $id ,
            'phone' => 'required|unique:customers,phone,' . $id ,
            'address' => 'required',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->name = $request->name;
        $customer->password = $request->password ? Hash::make($request->password) : $customer->password;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->status = $request->status;
        $customer->save();

        return redirect()->route('customers.index')->with('update', 'Success updated customer!');
    }

    public function destroy($id) { 
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customers.index')->with('delete', 'Success deleted customer!');
    }

    public function restore($id) {
        $customer = Customer::onlyTrashed()->findOrFail($id);
        $customer->restore();

        return redirect()->route('customers.index')->with('restore', 'Success restored customer!');
    }
}
