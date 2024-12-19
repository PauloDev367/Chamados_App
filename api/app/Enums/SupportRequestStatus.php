<?php

namespace App\Enums;

enum SupportRequestStatus: string
{
    case PENDENT = "PENDENT";
    case IN_PROGRESS = "IN_PROGRESS";
    case FINISHED_BY_CLIENT = "FINISHED_BY_CLIENT";
    case FINISHED_BY_SUPPORT = "FINISHED_BY_SUPPORT";
}
