<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\PlantData;

class Plant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'species',
    ];

    public function plantDatas() {
        return $this->hasMany(PlantData::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
