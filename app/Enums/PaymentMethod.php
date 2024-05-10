<?php
namespace App\Enums;


enum PaymentMethod:string
{
    case CACHE = 'cache';
    case STRIPE = 'stripe';
    case PAYPAL = 'paypal';
}