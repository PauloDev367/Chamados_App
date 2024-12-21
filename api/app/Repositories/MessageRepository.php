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
    public function getAll(int $supportRequestId)
    {
        return Message::where('support_requests_id', $supportRequestId)->get();
    }
    public function getLastMessageFromSupportRequest(int $supportRequestId){
        return Message::where('support_requests_id', $supportRequestId)
            ->latest('id')
            ->first();
    }
}
