<?php

namespace App\Http\Controllers\Backend;

use App\Room;
use App\Service;
use App\RoomType;
use App\Township;
use Illuminate\Http\Request;
// use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Sheets\RoomExport;
use App\Exports\Sheets\CommonSheet;

use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:room-list|room-create|room-edit|room-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:room-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:room-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:room-delete', ['only' => ['destroy']]);
    }

    public function index() {
        if("Admin" != auth()->user()->roles[0]->name) {
            $rooms = Room::select('id', 'price', 'photo', 'description', 'roomtype_id', 'township_id', 'capacity', 'size', 'deleted_at')->with(['services:id,name', 'roomtype:id,name', 'township:id,name'])->orderBy('id', 'desc')->get();
        } else {
            $rooms = Room::select('id', 'price', 'photo', 'description', 'roomtype_id', 'township_id', 'capacity', 'size', 'deleted_at')->withTrashed()->with(['services:id,name', 'roomtype:id,name', 'township:id,name'])->orderBy('id', 'desc')->get();
        }

        return view('backend.rooms.index', compact('rooms'));
    }

    public function create() {
        $roomtype = RoomType::select('id', 'name')->get();
        $township = Township::select('id', 'name')->get();
        $service = Service::select('id', 'name')->get();
        return view('backend.rooms.form',compact('roomtype', 'township', 'service'));
    }

    public function store(Request $request) {
        $request->validate([
            'price' => 'required',
            'photo' => 'required',
            'description' => 'required',
            'size' => 'required',
            'capacity' => 'required',
        ]);

        // If exist file, upload file
        if($request->hasfile('photo')) {
            $photo = $request->file('photo');
            $upload_dir = 'storage/image/';
            $name = $photo->getClientOriginalName();
            $photo->move($upload_dir,$name);
            $path = $upload_dir.$name;
        } else {
            $path = '';
        }

        $room = new Room;
        $room->photo = $path;
        $room->price = $request->price;
        $room->description = $request->description;
        $room->roomtype_id = $request->roomtype_id;
        $room->township_id = $request->township_id;
        $room->size = $request->size;
        $room->capacity = $request->capacity;
        $room->save();

        $services = $request->services;
        $room->services()->attach($services);

        return redirect()->route('rooms.index')->with('create', 'Success created room!');
    }

    public function show($id) {
        $room = Room::select('id', 'price', 'photo', 'description', 'roomtype_id', 'township_id', 'capacity', 'size')->with(['services:id,name', 'roomtype:id,name', 'township:id,name'])->findOrFail($id);

        return view('backend.rooms.detail', compact('room'));
    }

    public function edit($id) {
        $room = Room::select('id', 'price', 'photo', 'description', 'roomtype_id', 'township_id', 'capacity', 'size')->with(['services:id,name', 'roomtype:id,name', 'township:id,name'])->findOrFail($id);
        $roomtype = RoomType::select('id', 'name')->get();
        $township = Township::select('id', 'name')->get();
        $service = Service::select('id', 'name')->get();
        $room_service = $room->services()->wherePivot('notification','=',$id)->get();
    
        return view('backend.rooms.form', compact('roomtype', 'township', 'service', 'room', 'room_service'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'price' => 'required',
            'description' => 'required',
            'size' => 'required',
            'capacity' => 'required',
        ]);

        // If exist file, upload file
        if($request->hasfile('photo')) {
            $photo = $request->file('photo');
            $upload_dir = 'storage/image/';
            $name = $photo->getClientOriginalName();
            $photo->move($upload_dir,$name);
            $path = $upload_dir.$name;
        } else {
            $path = $request->oldphoto;
        }       

        $room = Room::findOrFail($id);
        $room->photo = $path;
        $room->price = $request->price;
        $room->description = $request->description;
        $room->roomtype_id = $request->roomtype_id;
        $room->township_id = $request->township_id;
        $room->size = $request->size;
        $room->capacity = $request->capacity;
        $room->save();

        $services = $request->services;        
        $room->services()->detach();
        $room->services()->attach($services);

        return redirect()->route('rooms.index')->with('update', 'Success updated room!');       
    }

    public function destroy($id) { 
        $room = Room::findOrFail($id);

        if(0 == $room->bookings()->count()) {
            $room->delete();
    
            return redirect()->route('rooms.index')->with('delete', 'Success deleted room!');
        } else {
            return redirect()->route('rooms.index')->with('not_allow', 'This room is not allow to delete!');
        }
    }

    public function restore($id) {
        $room = Room::onlyTrashed()->findOrFail($id);
        $room->restore();

        return redirect()->route('rooms.index')->with('restore', 'Success restored room!');
    }

    // public function excelDownload() {
    //     // dd("hello");die();
    //     $rooms = Room::select('id', 'price', 'photo', 'description', 'roomtype_id', 'township_id', 'capacity', 'size', 'deleted_at')->with(['services:id,name', 'roomtype:id,name', 'township:id,name'])->orderBy('id', 'desc')->get();

    //     $excelName = "Rooms Data";

    //     // dd($excelName);die();

    //     // dd($excelName);die();

    //     // if(count($products) == 0){
    //     //     return $this->errorResponse("There is no data.", Response::HTTP_BAD_REQUEST);
    //     // }

    //     $excel_data = [];
    //     // foreach ($rooms as $row) {
    //     //     // $last_date = '';
    //     //     $tmp = [];
    //     //     $tmp['Price'] = $row->price;
    //     //     $tmp['Description'] = $row->description;
    //     //     $tmp['Room Type'] = $row->roomtype->name;
    //     //     $tmp['Township'] = $row->township->name;
    //     //     $tmp['Size'] = $row->size;
    //     //     $tmp['Capacity'] = $row->capacity;
    //     //     $tmp['Services'] = $row->services->name;
            
    //     //     $excel_data[] = array_values($tmp);
    //     // }
        
    //     // dd($excel_data);die();

    //     $sheet = [
    //         'excel_heading' => ['Price','Description','Room Type', 'Township', 'Size', 'Capacity', 'Services'],
    //         'excel_data' => $excel_data,
    //         "excel_title" => $excelName,
    //     ];

    //     // dd($sheet);die();

    //     $file_name = 'quiet_place_excel/'.$excelName.date('YmdHis').'.xlsx';
    //     Excel::store(new CommonSheet($sheet), $file_name,);
    //     // $data['url'] =  Storage::disk('s3')->url($file_name);
    //     return redirect()->route('rooms.index')->with('restore', 'Success restored room!');
    // }

    // public function excelDownload() {
    //     return Excel::download(new RoomExport, 'users.xlsx');
    // }

    // public function excelDownload() {
    //     $rooms = Room::select('id', 'price', 'photo', 'description', 'roomtype_id', 'township_id', 'capacity', 'size', 'deleted_at')->with(['services:id,name', 'roomtype:id,name', 'township:id,name'])->orderBy('id', 'desc')->get();
    //     $excelName = "All Rooms Data";

    //     return Excel::download($excelName.'-'.date('Y-m-d'), function($excel) use($rooms) {
    //         $excel->sheet('All Rooms Data', function($sheet) use($rooms) {
    //             $sheet->loadView('report.excel.rooms')
    //                 ->with('rooms', $rooms);
    //         });
    //       })->export('xlsx');
    // }
}
