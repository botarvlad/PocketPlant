<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\PlantDataController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\DeviceController;
use App\Models\Plant;

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
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {

    // Plants
    Route::get('/plants', [PlantController::class, 'index'])->name('plants.index');
    Route::get('/plants/add', [PlantController::class, 'add'])->name('plants.add');
    Route::get('/plants/{plant}',[PlantController::class, 'view'])->name('plants.view');

    // Devices
    Route::get('/devices', [DeviceController::class, 'index'])->name('devices.index');
    Route::get('/devices/add', [DeviceController::class, 'add'])->name('devices.add');
    Route::get('/devices/{plant}',[DeviceController::class, 'view'])->name('devices.view');
});

Route::get('/plantdata', [PlantDataController::class, 'get'])->name('getplantdata');