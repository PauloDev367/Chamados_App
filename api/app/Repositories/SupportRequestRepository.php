<?php

namespace App\Repositories;

use App\Models\SupportRequest;
use App\Repositories\Ports\ISupportRequestRepository;

class SupportRequestRepository implements ISupportRequestRepository
{
    public function create(SupportRequest $supportRequest)
    {
        $supportRequest->save();
        return $supportRequest;
    }
}
