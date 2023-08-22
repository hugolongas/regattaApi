<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    protected $fillable = [
        'starting_port',
        'ending_port',
        'distance',
        'total_prize',
    ];

    public function weatherEffects()
    {
        return $this->belongsToMany(WeatherEffect::class);
    }
    
}
