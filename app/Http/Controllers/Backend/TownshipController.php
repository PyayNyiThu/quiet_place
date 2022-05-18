<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Township;
use Illuminate\Http\Request;
use Ladumor\OneSignal\OneSignal;
use Carbon\Carbon;

class TownshipController extends Controller
{
    public function __construct() {
        $this->middleware('permission:township-list|township-create|township-edit|township-delete', ['only' => ['index','store']]);
        $this->middleware('permission:township-create', ['only' => ['create','store']]);
        $this->middleware('permission:township-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:township-delete', ['only' => ['destroy']]);
    }

    public function index() {
        if("Admin" != auth()->user()->roles[0]->name) {
            $townships = Township::select('id', 'name', 'deleted_at')->orderBy('id', 'desc')->get();
        } else {
            $townships = Township::select('id', 'name', 'deleted_at')->withTrashed()->orderBy('id', 'desc')->get();
        }

        return view('backend.townships.index', compact('townships'));
    }

    public function create() {
        return view('backend.townships.form');
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

        // $dateS  = Carbon::now()->startOfMonth()->subMonth(3);
        // $dateE  = Carbon::now()->startOfMonth();

        // $revenueMonth = Township::select('name', 'created_at')->whereBetween('created_at', [$dateS, $dateE])->delete();
        // $revenueMonth->delete();

        // $revenueMonth = Township::whereMonth(
        //     'created_at', '>', Carbon::now(2)->subMonth()->month
        // )->get(['name', 'created_at']);
    
        // print_r($revenueMonth);die();
        // dd(Carbon::now()->subMonth(2)->month);die();

        return view('backend.townships.form', compact('township'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|max:100|unique:townships,name,' . $id,
        ]);

        $township = Township::findOrFail($id);
        $township->name = $request->name;
        $township->save();

        // $fields['include_player_ids'] = ['b70d827c-8fe1-11ec-8c45-b24d9d38c59a', '45d03844-8ef5-11ec-915e-8e2bcfb16119'];
        // $fields['include_player_ids'] = ['45d03844-8ef5-11ec-915e-8e2bcfb16119'];
        
        // $msg = 'Hello!! A tiny web push notification.!';
        
        // $test = OneSignal::sendPush($fields, $msg);
        // // $notificationID = '27f69c83-7047-4f47-9bac-0a59008035ab';

        // // $test = OneSignal::cancelNotification($notificationID);
        // $test = OneSignal::getNotifications();
        //  $test = OneSignal::getDevices();
        // $test = OneSignal::getDevice('48fb40de-90dc-11ec-b93c-1eb46322318c');
        // // $test = OneSignal::getApps();
        // // dd($test['notifications']);die();
        // $data = [];
        // foreach($test['notifications'] as $t) {
        //     // foreach($t as $d) {

        //         $data[] = $t;
        //     // }
        // }

        // dd($data);die();

    //     $fields = [
    //         'device_type'  => 5,
    //         // 'identifier'   => '7abcd558f29d0b1f048083e2834ad8ea4b3d87d8ad9c088b33c132706ff445f0',
    //         'timezone'     => '-28800',
    //         // 'game_version' => '1.1',
    //         // 'device_os'    => '7.0.4',
    //         'test_type'    => 1,
    //         // 'device_model' => "iPhone 8,2",
    //         'tags'         => array("foo" => "bar")
    //     ];
        
    //  $test = OneSignal::addDevice($fields); 

        // $fields = [
        //     'device_type'  => 5,
        //     // 'identifier'   => '7abcd558f29d0b1f048083e2834ad8ea4b3d87d8ad9c088b33c132706ff445f0',
        //     'timezone'     => '-28800',
        //     // 'game_version' => '1.1',
        //     // 'device_os'    => '7.0.4',
        //     'test_type'    => 1,
        //     // 'device_model' => "iPhone 8,2",
        //     // 'tags'         => array("foo" => "blah"),
        //     'notification_types' => 1,
        // ];
        // $playerId = 'b70d827c-8fe1-11ec-8c45-b24d9d38c59a';

        // $test = OneSignal::updateDevice($fields, $playerId); 

    //  dd($test);die();

    

        return redirect()->route('townships.index')->with('update', 'Success updated township!');
    }

    public function destroy($id) {
        $township = Township::findOrFail($id);

        if(0 == $township->rooms()->count()) {
            $township->delete();
            
            return redirect()->route('townships.index')->with('delete', 'Success deleted township!');
        } else {
            return redirect()->route('townships.index')->with('not_allow', 'This township is not allow to delete!');
        }
    }

    public function restore($id) {
        $township = Township::onlyTrashed()->findOrFail($id);
        $township->restore();

        return redirect()->route('townships.index')->with('restore', 'Success restored township!');
    }
}
