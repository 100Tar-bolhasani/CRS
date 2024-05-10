<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoomFullResource;
use App\Http\Resources\RoomResource;
use App\Models\Room;

class RoomController extends Controller
{
    public function index(){

        $perPage = request()->per_page ?? 30;
        $tasks = Room::search()->filter()->sort()->paginate($perPage);

        return RoomResource::collection($tasks);
    }
}
