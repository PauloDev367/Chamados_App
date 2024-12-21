<?php

namespace App\Services\Ports;

use App\Models\User;
use App\Http\Requests\AddMessageToSupportRequestRequest;

interface IMessageService
{
    public function supportAddMessage(User $support, AddMessageToSupportRequestRequest $request);
    public function getAll(User $support, int $supportRequestId);
}
