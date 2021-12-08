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
        'umid_sol',
        'umid_atm',
        'temp',
    ];

    public function plant() {
        return $this->belongsTo(Plant::class);
    }
}
