<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['name', 'phone', 'reservation_date', 'guests', 'status'];

    protected $casts = [
        'reservation_date' => 'datetime',
    ];
    //
}
