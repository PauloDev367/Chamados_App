<?php

namespace App\Services\Ports;

use App\Http\Requests\V1\CreateSupportRequestRequest;
use App\Models\User;

interface ISupportRequestService
{
    public function create(User $client, CreateSupportRequestRequest $request);
}
