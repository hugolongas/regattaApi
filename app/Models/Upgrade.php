<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upgrade extends Model
{
    
    protected $fillable = [
        'name',
        'description',
        'upgrade_type',
        'value',
        'price',
    ];

    public function ships()
    {
        return $this->belongsToMany(Ship::class);
    }
}
