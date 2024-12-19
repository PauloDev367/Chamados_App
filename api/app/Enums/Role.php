<?php

namespace App\Enums;

enum Role: string
{
    case CLIENT = "CLIENT";
    case SUPPORT = "SUPPORT";
    case ADMIN = "ADMIN";
}
