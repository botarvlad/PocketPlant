<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\PlantData;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/postPlantData', function (\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Storage::append('plantData-log.txt',
    "Time: " . now()->format('Y-m-d H:i:s') . ', ' .
    "Umid Sol: " . $request->get("umid_sol", "n/a") . '%, ' .
    "Umid Atm: " . $request->get("umid_atm", "n/a") . '%, ' .
    "Umid Sol: " . $request->get("temp", "n/a") . 'C, '
    );

    $data = new PlantData();

    $data->plant_id = 1;
    $data->umid_sol = $request->umid_sol;
    $data->umid_atm = $request->umid_atm;
    $data->temp = $request->temp;

    $data->save();
});