<?php

namespace App\Facade;

use Illuminate\Support\Facades\Facade;

class SmsService extends Facade
{
    protected static function getFacadeAccessor()
    {
       return \App\Services\SmsService::class ;
    }
}
