<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\PlantData;
use App\Models\PlantSoilMoisture;
use App\Models\PlantTemperature;
use App\Models\PlantAirHumidity;
use App\Models\Device;

class Plant extends Model
{
    use HasFactory;

    /**
    A plant has: 
        standing place (i.e. Office, bedroom, livingroom,...),
        
     */

    protected $fillable = [
        'name',
        'species',
        'picture'
    ];

    public function plantDatas() {
        return $this->hasMany(PlantData::class);
    }

    public function plantAirHumidities() {
        return $this->hasMany(PlantAirHumidity::class);
    }

    public function plantSoilMoistures() {
        return $this->hasMany(PlantSoilMoisture::class);
    }

    public function plantTemperatures() {
        return $this->hasMany(PlantTemperature::class);
    }

    public function device() {
        return $this->hasOne(Device::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    // Atributes
    // public function currentDevice () {

    // }
}
