<?php
namespace App\Enums;


enum GuestPreferenceType:string
{
    case LOCAL = 'local';
    case GLOBAL = 'global';
    case ROOM = 'room';
}