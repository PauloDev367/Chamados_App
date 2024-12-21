<?php

namespace App\Enums;

enum MessageStatus: string
{
    case NO_MESSAGES = "NO_MESSAGES";
    case WAITING_SUPPORT_RESPONSE = "WAITING_SUPPORT_RESPONSE";
    case WAITING_CLIENT_RESPONSE = "WAITING_CLIENT_RESPONSE";
}
