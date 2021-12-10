<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PlantData;

class PlantDataController extends Controller
{
    function get() {
        $plant = PlantData::where('id', 1)->get();

        return $plant[0]->umid_sol;
    }
}
