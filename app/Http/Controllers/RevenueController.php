<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\RevenueResource;
use App\Http\Resources\RoomFullResource;
use App\Http\Resources\RoomResource;
use App\Models\Payment;
use App\Models\Room;

class RevenueController extends Controller
{
    public function index(){

        $payment = Payment::revenue()->get();

        return RevenueResource::collection($payment);
    }
}
