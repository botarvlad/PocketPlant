<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\PlantData;
use App\Models\Plant;
use DB;

use Inertia\Inertia;

class DeviceController extends Controller
{
    public function index() {
        return Inertia::render('Device/Devices', [
            'devices' => Device::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function view(Device $device) {
        return Inertia::render('Device/DeviceDetails', [
            'device' => $device,
            'plant_host' => Plant::where('id', $device->plant_id)->first(),
            'plants' => Plant::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function add() {

    //    $device_request = DB::table('plant_data')->latest('created_at')->first();

    //    $new_device = DB::table('devices_list')->where('mac_address', $device_request->mac)->get();

        $new_devices = DB::table('devices_list')
            ->join('plant_data', function ($join) {
                $join->on('devices_list.mac_address', '=', 'plant_data.mac')
                     ->where('devices_list.claimed', '=', 0);
            })
            ->get();
        
        // $new_devices = DB::table('devices_list')
        //     ->join('plant_data', 'devices_list.mac_address', '=', 'plant_data.mac')
        //     ->get();

        return Inertia::render('Device/RegisterDevice', [
            'new_devices' => $new_devices
        ]);
    }

    public function switch_plant(Request $request) {
        $device = Device::find($request->device_id)->get();
        
        $device[0]->plant_id = $request->plant_host['id'];

        $device[0]->save();

        return redirect()->back();
    }

    public function claim($mac) {

        $device = new Device();

        $device->user_id = auth()->user()->id;
        $device->mac_address = $mac;
    
        $device->save();

        DB::table('devices_list')->where('mac_address', $mac)->update(['claimed' => 1]);

        return redirect()->back();

    }
}
