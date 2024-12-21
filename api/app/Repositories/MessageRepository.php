<?php

namespace App\Repositories;

use App\Models\Message;
use App\Repositories\Ports\IMessageRepository;

class MessageRepository implements IMessageRepository
{
    public function create(Message $message)
    {
        $message->save();
        return $message;
    }
}
