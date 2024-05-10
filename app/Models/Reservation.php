<?php

namespace App\Models;

use App\Enums\PromotionType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Reservation extends Model
{
    public const TAX = 10;

    protected $fillable = [
        'room_id',
        'start_date',
        'end_date'
    ];

    protected function totalCost(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->calculateCost(),
        );
    }

    public function promotions(): BelongsToMany
    {
        return $this->belongsToMany(Promotion::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function guests(): HasMany
    {
        return $this->hasMany(ReservationGuest::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    private function calculateCost()
    {
        $days = Carbon::parse($this->start_date)->diffInDays(Carbon::parse($this->end));
        return $this->calculatePromotion($this->room->price * $days);
    }

    private function calculatePromotion($cost)
    {
        $totalDiscount = 0;

        foreach ($this->promotions as $key => $promotion) {
            if($promotion->type == PromotionType::PERCENT)
            {
                $totalDiscount += $cost * $promotion->amount /100;
            }
            elseif ($promotion->type == PromotionType::AMOUNT){
                $totalDiscount += $promotion->amount;
            }
        }

        return $cost - $totalDiscount;
    }
}