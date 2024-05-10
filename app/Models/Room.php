<?php

namespace App\Models;

use App\Enums\RoomType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Builder;

class Room extends Model
{
    protected $fillable = [
        'type',
        'price',
        'capacity',
        'available',
        'title',
        'description'
    ];


    protected $casts = [
        'type' => RoomType::class,
    ];

    public function scopeSearch(Builder $query): void
    {
        $query->when(\request()->search, fn($sq) => $sq->where(function ($row) use ($query) {
            $row->where('title', 'LIKE', '%' . \request()->search . '%')
                ->orWhere('description', 'LIKE', '%' . \request()->search . '%');
        }));
    }

    public function scopeFilter(Builder $query): void
    {
        $query->when(\request()->available, fn($sq) => $sq->where('available', \request()->available))
            ->when(\request()->type, fn($sq) => $sq->where('type', \request()->type))
            ->when(\request()->capacity, fn($sq) => $sq->where('capacity', \request()->capacity))
            ->when(\request()->price, fn($sq) => $sq->whereBetween('price', [\request()->min_price, \request()->max_price]))
            ->when(\request()->start_date , function($q) {
                $q->whereDoesntHave('reservations', function($reservations) {
                    $reservations->whereBetween('start_date', [\request()->start_date, \request()->end_date])
                    ->orWhereBetween('end_date', [\request()->start_date, \request()->end_date])
                    ->orWhere(fn ($q) => $q->where('start_date', '<', \request()->start_date)->where('end_date', '>', \request()->end_date));
                });
            });
    }

    public function scopeSort(Builder $query): void
    {
        $query->when(\request()->sort, fn($sq) => $sq->orderByDesc(\request()->sort));
    }

    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(Amenity::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function reviews(): HasManyThrough
    {
        return $this->hasManyThrough(Review::class, Reservation::class);
    }
}
