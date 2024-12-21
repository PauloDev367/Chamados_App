<?php

namespace App\Repositories\Ports;

use App\Models\Message;

interface IMessageRepository
{
    public function create(Message $message);
}
