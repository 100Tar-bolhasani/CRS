<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Guest extends Model
{
    protected $fillable = [
        'mobile',
        'first_name',
        'last_name'
    ];


    public function profile(): HasOne
    {
        return $this->hasOne(GuestProfile::class);
    }

    public function preferences(): HasMany
    {
        return $this->hasMany(GuestPreference::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
