<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationGuest extends Model
{
    protected $fillable = [
        'guest_id',
        'reservation_id'
    ];
}
