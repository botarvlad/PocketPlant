<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plant;
use App\Models\PlantData;

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
}
