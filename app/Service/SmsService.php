<?php

namespace App\Services;

use App\Enums\GuestPreferenceType;
use App\Models\Room;

class SmsService
{
    public function sendBirthDateSms($guests)
    {
        foreach ($guests as $key => $guest) {
            $content = $guest->with('preferences', function ($prefer){
                $prefer->where('type', GuestPreferenceType::ROOM);
            })->get();

            $preferRoom = $content->preferences?->content;

            $availableRooms = Room::whereIn('id', $preferRoom)->whereDoesntHave('reservations', function($reservations) use ($guest){
                $reservations->where('start_date', $guest->profile?->birthday)
                ->orWhere('end_date', $guest->profile?->birthday);
            });

            //NEED TO SEND SMS OR SOMETHING ELSE LIKE EMAIL
        }
    }
}
