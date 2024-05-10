<?php

namespace App\Models;

use App\Enums\Gender;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GuestProfile extends Model
{
    protected $fillable = [
        'guest_id',
        'country_id',
        'birthday',
        'gender'
    ];

    protected $casts = [
        'gender' => Gender::class,
    ];

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }
}
