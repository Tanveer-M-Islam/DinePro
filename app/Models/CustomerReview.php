<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerReview extends Model
{
    protected $fillable = [
        'name',
        'review',
        'rating',
        'is_featured',
        'status',
    ];

    //
}
