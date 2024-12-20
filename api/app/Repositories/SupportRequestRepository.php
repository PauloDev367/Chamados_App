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
    public function getAllFromClient(int $client_id)
    {
        return SupportRequest::where("client_id", $client_id)
            ->paginate(10);
    }

    public function update(SupportRequest $supportRequest)
    {
        $supportRequest->save();
        return $supportRequest;
    }
}
