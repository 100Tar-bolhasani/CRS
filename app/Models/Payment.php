<?php

namespace App\Models;

use App\Enums\PaymentMethod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Payment extends Model
{
    protected $fillable = [
        'reservation_id',
        'method',
        'refund',
        'data'
    ];

    protected $casts = [
        'method' => PaymentMethod::class,
    ];

    public function scopeRevenue(Builder $query): void
    {
        $query->whereHas('reservation', function ($reservation) {
            $reservation->whereBetween('start_date', [\request()->start_date, \request()->end_date]);
        })->whereHas('room', function ($room) {
            $room->groupBy('type');
        })->sum('refund');
    }

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }
}
