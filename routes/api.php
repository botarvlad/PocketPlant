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

    $data = new PlantData();

    $data->mac = $request->mac;
    $data->umid_sol = $request->umid_sol;
    $data->umid_atm = $request->umid_atm;
    $data->temp = $request->temp;

    $data->save();
});

Route::get('/getPlantData', function (\Illuminate\Http\Request $request) {

    $data = DB::table('plant_data')->orderBy('created_at', 'desc')->first();

    return $data->umid_sol;
});