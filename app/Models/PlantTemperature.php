<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantTemperature extends Model
{
    use HasFactory;

    protected $fillable = [
        'temp',
    ];

    protected $casts = [
        'temp' => 'float',
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
