<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationPromotion extends Model
{
    protected $fillable = [
        'reservation_id',
        'promotion_id'
    ];
}
