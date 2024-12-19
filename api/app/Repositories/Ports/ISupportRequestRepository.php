<?php

namespace App\Repositories\Ports;

use App\Models\SupportRequest;

interface ISupportRequestRepository
{
    public function create(SupportRequest $supportRequest);
}
