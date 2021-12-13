<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plant;
use App\Models\PlantData;
use App\Models\Device;

use Inertia\Inertia;

class PlantController extends Controller
{
    public function index() {
        return Inertia::render('Plant/Plants', [
            'plants' => Plant::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function view(Plant $plant) {
        return Inertia::render('Plant/PlantDetails', [
            'plant_datas' => PlantData::where('plant_id', $plant->id)->get()
        ]);
    }

    public function add() {
        // dd(Device::where('user_id', auth()->user()->id)->get());
        return Inertia::render('Plant/CreatePlant', [
            'devices' => Device::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function store(Request $request) {
        
        $plant = new Plant($request->only([
            'name',
            'species'
        ]));
        
        $plant->user_id = auth()->user()->id;
        $ceva = Device::where('mac_address', $request->device)->get();
        $plant->device_id = $ceva[0]->id;

        $plant->save();

        return redirect()->route('plants.index');
    }
}
