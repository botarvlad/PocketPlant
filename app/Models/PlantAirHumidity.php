<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantAirHumidity extends Model
{
    use HasFactory;

    protected $fillable = [
        'umid_atm',
    ];

    protected $casts = [
        'umid_atm' => 'float',
    ];

    protected $attributes = [
        'plant_id' => 1,
    ];

    public function plant() {
        return $this->belongsTo(Plant::class);
    }

    // public function device() {
    //     return $this->belongsTo(Device::class);
    // }
}
