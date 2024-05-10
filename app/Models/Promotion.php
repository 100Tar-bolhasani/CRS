<?php

namespace App\Models;

use App\Enums\PromotionType;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'promotionable_id',
        'promotionable_type',
        'type',
        'amount',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'type' => PromotionType::class,
    ];
}
