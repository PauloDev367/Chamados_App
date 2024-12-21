<?php

namespace App\Services;

use App\Enums\Role;
use App\Models\User;
use App\Services\Ports\IMessageService;
use App\Repositories\Ports\IMessageRepository;
use Illuminate\Validation\UnauthorizedException;
use App\Repositories\Ports\ISupportRequestRepository;
use App\Http\Requests\AddMessageToSupportRequestRequest;
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

        
    }
}
