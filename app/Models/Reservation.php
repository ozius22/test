<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    function guest(){
        return $this->belongsTo(Guest::class);
    }

    function room(){
        return $this->belongsTo(Room::class);
    }
}
