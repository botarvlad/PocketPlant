<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\PlantData;

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

    public function user() {
        return $this->belongsTo(User::class);
    }
}
