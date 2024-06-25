<?php
namespace App\Enums;
enum OrderTypeEnum : String{
    case REQUESTED ='requested';
    case ACCEPTED = 'accepted';
    case FINISHED = 'finished';
    case CANCELLED = 'cancelled';    
}