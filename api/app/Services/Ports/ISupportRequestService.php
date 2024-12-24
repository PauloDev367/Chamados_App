<?php

namespace App\Services\Ports;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\V1\CreateSupportRequestRequest;

interface ISupportRequestService
{
    public function create(User $client, CreateSupportRequestRequest $request);
    public function getAllFromClient(User $client);
    public function clientFinishSupporRequest(User $client, int $supportRequestId);
    public function clientGetOne(User $client, int $id);
    public function getAllAsSupport(User $support, Request $request);
    public function supportGetAService(User $support, int $id);
    public function supportGetOne(User $support, int $id);
    public function supportFinishService(User $support, int $id);
}
