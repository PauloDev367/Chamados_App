<?php

namespace App\Repositories\Ports;

use App\Models\SupportRequest;

interface ISupportRequestRepository
{
    public function create(SupportRequest $supportRequest);
    public function getAllFromClient(int $clientId);
    public function update(SupportRequest $supportRequest);
    public function getOneFromClient(int $supportRequestId, int $clientId);
}
