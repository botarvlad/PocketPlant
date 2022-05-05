<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plant;
use App\Models\PlantData;
use App\Models\PlantAirHumidity;
use App\Models\PlantSoilMoisture;
use App\Models\PlantTemperature;
use App\Models\Device;

use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PlantController extends Controller
{
    public function index() {
        return Inertia::render('Plant/Plants', [
            'plants' => Plant::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function view(Plant $plant) {
        $plant_stats = []; 
        $plant_datas = [];

        $plant_soil_records = PlantSoilMoisture::where('plant_id', $plant->id)->get()->toArray();
        $plant_temp_records = PlantTemperature::where('plant_id', $plant->id)->get()->toArray();
        $plant_air_records = PlantAirHumidity::where('plant_id', $plant->id)->get()->toArray();

        $plant_datas['plant_soil_records'] = $plant_soil_records;
        $plant_datas['plant_temp_records'] = $plant_temp_records;
        $plant_datas['plant_air_records'] = $plant_air_records;

        // ia ultimul record din watered_plants al plantei
        $last_time_watered = DB::table('water_times')->where('plant_id', $plant->id)->latest()->first();
        $plant_stats['last_time_watered'] = $last_time_watered;
        
        return Inertia::render('Plant/PlantDetails', [
            'plant_datas' => $plant_datas,
            'plant_care' => DB::table('plants_care')->where('name', $plant->species)->first(),
            'device_attached' => $plant->device,
            'plant' => $plant,
            'plant_stats' => $plant_stats
        ]);
    }

    public function add() {
        // dd(Device::where('user_id', auth()->user()->id)->get());
        return Inertia::render('Plant/CreatePlant', [
            'devices' => Device::where('user_id', auth()->user()->id)->get(),
            'plants' => DB::table('plants_care')->get()
        ]);
    }

    public function store(Request $request) {

        $request->validate([
            'name' => ['required', 'min:3'],
            'species' => ['required'],
            'pot_type' => ['required'],
            'pot_size' => ['required'],
            'soil_type' => ['required'],
            'height' => ['required'],
        ]);
        
        $plant = new Plant($request->only([
            'name',
            'species',
            'pot_type',
            'pot_size',
            'soil_type',
            'height',
        ]));

        $plant->user_id = auth()->user()->id;
        // $ceva = Device::where('mac_address', $request->device)->get();
        // $plant->device_id = $ceva[0]->id;

        $plant->save();

        return redirect()->route('plants.index');
    }
}
