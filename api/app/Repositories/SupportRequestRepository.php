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
    public function getAllFromClient(int $clientId)
    {
        return SupportRequest::where("client_id", $clientId)
            ->paginate(10);
    }

    public function update(SupportRequest $supportRequest)
    {
        $supportRequest->save();
        return $supportRequest;
    }
    public function getOneFromClient(int $supportRequestId, int $clientId)
    {
        return SupportRequest::where('id', $supportRequestId)
            ->where("client_id", $clientId)
            ->first();
    }
}
