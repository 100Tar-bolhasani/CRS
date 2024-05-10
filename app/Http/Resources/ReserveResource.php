<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReserveResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'payment' => $this->payment,
            'room' => $this->room,
            'guests' => $this->guests,
            'totalCost' => $this->total_cost
        ];
    }
}
