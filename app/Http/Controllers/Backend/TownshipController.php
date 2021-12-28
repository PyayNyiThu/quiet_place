<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Township;
use Illuminate\Http\Request;

class TownshipController extends Controller
{
    public function index() {
        $townships = Township::select('id', 'name')->orderBy('id', 'desc')->get();

        return view('backend.townships.index', compact('townships'));
    }

    public function create() {
        return view('backend.townships.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:townships|max:100',
        ]);

        $township = new Township();
        $township->name = $request->name;
        $township->save();

        return redirect()->route('townships.index')->with('create', 'Success created township!');
    }

    public function edit($id) {
        $township = Township::select('id', 'name')->findOrFail($id);

        return view('backend.townships.edit', compact('township'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|max:100|unique:townships,name,' . $id,
        ]);

        $township = Township::findOrFail($id);
        $township->name = $request->name;
        $township->save();

        return redirect()->route('townships.index')->with('update', 'Success updated township!');
    }

    public function destroy($id) { 
        $township = Township::findOrFail($id);
        $township->delete();

        return redirect()->route('townships.index')->with('delete', 'Success deleted township!');
    }
}
