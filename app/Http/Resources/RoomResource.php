<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => $this->type,
            'price' => $this->price,
            'capacity' => $this->capacity,
            'available' => $this->available,
            'title' => $this->title,
            'description' => $this->description
        ];
    }
}
