<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\PlantData;
use App\Models\Plant;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plant_host',
        'mac_address',
    ];

    // public function plants() {
    //     return $this->hasMany(Plant::class);
    // }

    public function plantDatas() {
        return $this->hasMany(PlantData::class);
    }

    public function plants() {
        return $this->belongsTo(Plant::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }    
}
