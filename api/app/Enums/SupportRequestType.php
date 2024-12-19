<?php

namespace App\Enums;

enum SupportRequestType: string
{
    case TECHNICAL = "TECHNICAL";
    case FINANCIAL = "FINANCIAL";
    case OTHER = "OTHER";
}
