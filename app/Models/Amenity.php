<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Amenity extends Model
{
    protected $fillable = [
        'title',
        'icon'
    ];


    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class);
    }
}
