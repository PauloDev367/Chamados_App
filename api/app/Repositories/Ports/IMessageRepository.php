<?php

namespace App\Repositories\Ports;

use App\Models\Message;

interface IMessageRepository
{
    public function create(Message $message);
    public function getAll(int $supportRequestId);
    public function getLastMessageFromSupportRequest(int $supportRequestId);
}
