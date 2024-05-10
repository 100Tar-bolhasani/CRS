<?php

namespace App\Models;

use App\Enums\GuestPreferenceType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GuestPreference extends Model
{
    protected $fillable = [
        'guest_id',
        'type',
        'content'
    ];

    protected $casts = [
        'type' => GuestPreferenceType::class,
    ];

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }
}
