<?php

namespace App\Enums;

enum SupportRequestUrgency: string
{
    case LOW = "LOW";
    case MEDIUM = "MEDIUM";
    case URGENCY = "URGENCY";
}
