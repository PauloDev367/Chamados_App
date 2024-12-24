<?php

namespace App\Repositories\Ports;

use Illuminate\Http\Request;
use App\Models\SupportRequest;
use App\Models\User;

interface ISupportRequestRepository
{
    public function create(SupportRequest $supportRequest);
    public function getAllFromClient(int $clientId, Request $request);
    public function getAll(Request $request, User $support);
    public function update(SupportRequest $supportRequest);
    public function getOneFromClient(int $supportRequestId, int $clientId);
    public function getOne(int $supportRequestId);
}
