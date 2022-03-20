<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpMqtt\Client\Facades\MQTT;

use App\Models\PlantData;

class PlantDataController extends Controller
{
    public function get() {
        $plant = PlantData::where('id', 1)->get();

        return $plant[0]->umid_sol;
    }

    public function postData(Request $request) {
        dd($request);
    }
}
