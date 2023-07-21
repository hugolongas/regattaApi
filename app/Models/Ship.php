<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    protected $fillable = [
        'initial_athletes',
        'current_athletes',
        'max_athletes',
        'speed',
        'acceleration',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function athletes()
    {
        return $this->hasMany(Athlete::class);
    }

    public function upgrades()
    {
        return $this->belongsToMany(Upgrade::class);
    }
}