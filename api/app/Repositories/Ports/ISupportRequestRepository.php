<?php

namespace App\Repositories\Ports;

use App\Models\SupportRequest;

interface ISupportRequestRepository
{
    public function create(SupportRequest $supportRequest);
    public function getAllFromClient(int $client_id);
    public function update(SupportRequest $supportRequest);
}
