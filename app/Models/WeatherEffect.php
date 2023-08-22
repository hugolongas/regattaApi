<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeatherEffect extends Model
{
    protected $fillable = [
        'name',
        'description',
        'effect_type',
        'value',
    ];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
}
