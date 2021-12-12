<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\PlantData;

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
            'device' => Device::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function add() {
        //$plantData = PlantData::where('mac')
        return Inertia::render('Device/RegisterDevice', [
            'new_devices' => PlantData
        ]);
    }
}
