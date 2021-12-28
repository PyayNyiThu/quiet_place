<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index() {
        $services = Service::select('id', 'name', 'photo')->orderBy('id', 'desc')->get();

        return view('backend.services.index', compact('services'));
    }

    public function create() {
        return view('backend.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "name"=>'required|max:100',
        ]);

        // If exist file, upload file
        if($request->hasfile('photo')) {
            $photo = $request->file('photo');
            $upload_dir = 'storage/image/';
            $name = $photo->getClientOriginalName();
            $photo->move($upload_dir, $name);
            $path = $upload_dir.$name;
        } else {
            $path='';
        }

        $service = new Service;
        $service->name = $request->name;
        $service->photo = $path;
        $service->save();

        return redirect()->route('services.index')->with('create', 'Success created service!');
    }

    public function edit($id)
    {
        $service = Service::select('id', 'name', 'photo')->findOrFail($id);

        return view('backend.services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
         $request->validate([
            "name"=>'required|max:100',
        ]);

        // If exist file, upload file
         if($request->hasfile('photo')) {
            $photo = $request->file('photo');
            $upload_dir = 'storage/image/';
            $name = $photo->getClientOriginalName();
            $photo->move($upload_dir, $name);
            $path = $upload_dir.$name;
        } else {            
            $path = $request->oldphoto;
        }

        $service = Service::findOrFail($id);
        $service->name = request('name');
        $service->photo = $path;
        $service->save();

        return redirect()->route('services.index')->with('update', 'Success updated service!');
    }

    public function destroy($id) { 
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('services.index')->with('delete', 'Success deleted service!');
    }
}
