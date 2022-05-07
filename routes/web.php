<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Http\Controllers\PlantDataController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\DeviceController;
use App\Models\Plant;
use App\Models\PlantAirHumidity;
use App\Models\PlantSoilMoisture;
use App\Models\PlantTemperature;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'plants' => Plant::where('user_id', auth()->user()->id)->get(),
    ]);
})->name('dashboard');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {

    // Plants
    Route::get('/plants', [PlantController::class, 'index'])->name('plants.index');
    Route::get('/plants/add', [PlantController::class, 'add'])->name('plants.add');
    Route::post('/plants/create',[PlantController::class, 'store'])->name('plants.store');
    Route::get('/plants/{plant}',[PlantController::class, 'view'])->name('plants.view');
    Route::delete('/plants/{plant}/delete', [PlantController::class, 'destroy'])->name('plants.destroy');

    // Devices
    Route::patch('/devices/switch_plant',[DeviceController::class, 'switch_plant'])->name('devices.switch_plant');
    Route::get('/devices', [DeviceController::class, 'index'])->name('devices.index');
    Route::get('/devices/add', [DeviceController::class, 'add'])->name('devices.add');
    Route::get('/devices/{device}',[DeviceController::class, 'view'])->name('devices.view');
    Route::patch('/devices/{device}',[DeviceController::class, 'claim'])->name('devices.claim');
    Route::patch('/devices/{device}/unsign', [DeviceController::class, 'unsign'])->name('devices.unsign');
});