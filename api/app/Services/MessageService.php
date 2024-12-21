<?php

namespace App\Services;

use App\Enums\MessageStatus;
use App\Enums\MessageType;
use App\Enums\Role;
use App\Models\User;
use App\Services\Ports\IMessageService;
use App\Repositories\Ports\IMessageRepository;
use Illuminate\Validation\UnauthorizedException;
use App\Repositories\Ports\ISupportRequestRepository;
use App\Http\Requests\AddMessageToSupportRequestRequest;
use App\Models\Message;
use DomainException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MessageService implements IMessageService
{
    public function __construct(
        private readonly IMessageRepository $repository,
        private readonly ISupportRequestRepository $iSupportRequestRepository,
    ) {}

    public function supportAddMessage(User $support, AddMessageToSupportRequestRequest $request, int $supportRequestId)
    {
        if ($support->role != (Role::SUPPORT)->value) {
            throw new UnauthorizedException('Unauthorized action');
        }

        $supportRequest = $this->iSupportRequestRepository->getOne($supportRequestId);
        if ($supportRequest == null) {
            throw new ModelNotFoundException("Support request not founded");
        }

        if ($supportRequest->support_id != $support->id) {
            throw new DomainException("You don't have permission to add a message to this service request");
        }

        $message = new Message();
        $message->message = $request->message;
        $message->client_id = $supportRequest->client_id;
        $message->support_id = $support->id;
        $message->support_requests_id = $supportRequest->id;
        $message->status = (MessageStatus::WAITING_CLIENT_RESPONSE)->value;
        $message->type = (MessageType::SUPPORT)->value;


        $created = $this->repository->create($message);
        return $created;
    }
}
