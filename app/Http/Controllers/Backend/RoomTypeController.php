<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    public function index() {
        $room_types = RoomType::select('id', 'name')->orderBy('id', 'desc')->get();

        return view('backend.room_types.index', compact('room_types'));
    }

    public function create()
    {
        return view('backend.room_types.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:100',
        ]);

        $room_type = new RoomType();
        $room_type->name = $request->name;
        $room_type->save();

        return redirect()->route('room-types.index')->with('create', 'Success created roomtype!');
    }

    public function edit($id)
    {
        $room_type = RoomType::select('id', 'name')->findOrFail($id);

        return view('backend.room_types.edit', compact('room_type'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|max:100',
        ]);

        $room_type = RoomType::findOrFail($id);
        $room_type->name = $request->name;
        $room_type->save();

        return redirect()->route('room-types.index')->with('update', 'Success updated roomtype!');
    }

    public function destroy($id) { 
        $room_type = RoomType::findOrFail($id);
        $room_type->delete();

        return redirect()->route('room-types.index')->with('delete', 'Success deleted roomtype!');
    }
}
