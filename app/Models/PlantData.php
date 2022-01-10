<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Plant;
use App\Models\User;

class PlantData extends Model
{
    use HasFactory;

    protected $fillable = [
        'mac',
        'umid_sol',
        'umid_atm',
        'temp',
    ];

    protected $casts = [
        'umid_sol' => 'float',
        'umid_atm' => 'float',
        'temp' => 'float'
    ];

    public function plant() {
        return $this->belongsTo(Plant::class);
    }

    public function device() {
        return $this->belongsTo(Device::class);
    }
}
