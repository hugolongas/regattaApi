<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    
    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
}
