<?php

namespace App\Http\Controllers;

use App\Enums\PromotionType;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReserveResource;
use App\Models\Guest;
use App\Models\Promotion;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReserveController extends Controller
{
    public function store(Request $request){
        $guest = $request->guest; //Main Guest 
        //Create Reservation


        
        //We have a loyalty program as after 4th reservation, main guest can use a promotion.
        $countOfReservation = 4; //Or 9 | 14 | 19
        if($countOfReservation%5 == 4){
            Promotion::create([
                'promotionable_id' => $guest->id,
                'promotionable_type' => 'App/Models/Guest',
                'type'=> PromotionType::PERCENT,
                'amount'=> 10,
                'start_date'=> Carbon::now(),
                'end_date'=>  Carbon::now()->addMonth(2)
            ]);
        }
    }

    public function view(Reservation $reserve){
        return new ReserveResource($reserve);
    }
}
