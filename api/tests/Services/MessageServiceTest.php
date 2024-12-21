<?php

namespace Services;

use App\Enums\Role;
use Tests\TestCase;
use App\Models\User;
use App\Services\MessageService;
use App\Repositories\Ports\IMessageRepository;
use Illuminate\Validation\UnauthorizedException;
use App\Repositories\Ports\ISupportRequestRepository;
use App\Http\Requests\AddMessageToSupportRequestRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MessageServiceTest extends TestCase
{

    public function test_message_should_not_be_add_to_service_request_if_user_id_is_not_support()
    {
        $iMessageRepository = $this->createMock(IMessageRepository::class);
        $iSupportRequestRepository = $this->createMock(ISupportRequestRepository::class);

        $support = new User();
        $support->role = (Role::CLIENT)->value;

        $request = new AddMessageToSupportRequestRequest();
        $request->merge([
            'user_role' => 'non_client',
        ]);
        $service = new MessageService($iMessageRepository, $iSupportRequestRepository);

        $this->expectException(UnauthorizedException::class);
        $service->supportAddMessage($support, $request, 1);
    }
    public function test_message_should_not_be_add_to_service_request_if_supportrequest_is_not_found()
    {
        $iMessageRepository = $this->createMock(IMessageRepository::class);
        $iSupportRequestRepository = $this->createMock(ISupportRequestRepository::class);
        $iSupportRequestRepository->method('getOne')
            ->willReturn(null);

        $support = new User();
        $support->role = (Role::SUPPORT)->value;

        $request = new AddMessageToSupportRequestRequest();
        $request->merge([
            'user_role' => 'non_client',
        ]);
        $service = new MessageService($iMessageRepository, $iSupportRequestRepository);

        $this->expectException(ModelNotFoundException::class);
        $service->supportAddMessage($support, $request, 1);
    }
}
