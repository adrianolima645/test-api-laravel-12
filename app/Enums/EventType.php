<?php

namespace App\Enums;

enum EventType: string
{
    case Borrow = 'borrow';
    case Return = 'return';
    case Reservation = 'reservation';
}
