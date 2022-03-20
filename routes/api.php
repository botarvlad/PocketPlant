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

Route::post('/postMacAddr', function (\Illuminate\Http\Request $request) {
    
    // dd($request); store the request somewhere...


});

Route::post('/postPlantData', function (\Illuminate\Http\Request $request) {
    // \Illuminate\Support\Facades\Storage::append("arduino-log.txt",
    // "Time: " . now()->format("Y-m-d H:i:s") . ", " .
    // "asdadasd: " . $request->get("umid_sol", "n/a") . '%. ');
    $data = new PlantData();
    // $data->plant_id = 1;

    $data->mac = $request->get("mac");
    $data->umid_sol = $request->get("umid_sol");
    $data->umid_atm = $request->get("umid_atm");
    $data->temp = $request->get("temp");

    \Illuminate\Support\Facades\Storage::append("arduino-log.txt",
    "Time: " . now()->format("Y-m-d H:i:s") . ", " .
    "plant_data: " . $data);

    $data->save();
});

Route::get('/getPlantData', function (\Illuminate\Http\Request $request) {

    $data = DB::table('plant_data')->orderBy('created_at', 'desc')->first();

    return $data->umid_sol;
});