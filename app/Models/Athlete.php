<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Athlete extends Model
{
    protected $fillable = [
        'name',
        'strength',
        'stamina',
        'experience',
        'price',
        'ship_id',
    ];

    public function ship()
    {
        return $this->belongsTo(Ship::class);
    }
}
