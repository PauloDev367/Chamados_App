<?php

namespace Services;

use App\Enums\MessageStatus;
use App\Enums\Role;
use Tests\TestCase;
use App\Models\User;
use DomainException;
use App\Models\SupportRequest;
use App\Enums\SupportRequestStatus;
use App\Services\SupportRequestService;
use Illuminate\Validation\UnauthorizedException;
use App\Http\Requests\V1\CreateSupportRequestRequest;
use App\Repositories\Ports\ISupportRequestRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class SupportRequestServiceTest extends TestCase
{
    public function test_should_not_create_support_requestservice_if_user_role_is_not_client()
    {
        $repository = $this->createMock(ISupportRequestRepository::class);

        $client = new User();
        $client->role = (Role::SUPPORT)->value;
        $request = new \App\Http\Requests\V1\CreateSupportRequestRequest();
        $request->merge([
            'user_role' => 'non_client',
        ]);

        $service = new SupportRequestService($repository);

        $this->expectException(UnauthorizedException::class);
        $service->create($client, $request);
    }
    public function test_should_create_requestservice_if_user_role_is_client()
    {
        $supportRequest = new SupportRequest();
        $supportRequest->title = "title";
        $supportRequest->type = "type";
        $supportRequest->urgency = "urgency";
        $supportRequest->status = (SupportRequestStatus::PENDENT)->value;
        $supportRequest->client_id = 123;
        $supportRequest->message = "message";
        $supportRequest->print = null;
        $supportRequest->supportrequest_chat_status = (MessageStatus::NO_MESSAGES)->value;
        $supportRequest->client_email = null;

        $repository = $this->createMock(ISupportRequestRepository::class);
        $repository->method('create')
            ->willReturn($supportRequest);

        $client = new User();
        $client->id = 123;
        $client->role = (Role::CLIENT)->value;
        $request = new \App\Http\Requests\V1\CreateSupportRequestRequest();

        $request->merge([
            'user_role' => 'non_client',
            'title' => 'title',
            'type' => 'type',
            'urgency' => 'urgency',
            'message' => 'message',
        ]);

        $service = new SupportRequestService($repository);

        $created = $service->create($client, $request);
        $this->assertEquals($created, $supportRequest);
    }
    public function test_should_not_get_client_requestservice_if_user_role_is_not_client()
    {
        $repository = $this->createMock(ISupportRequestRepository::class);

        $client = new User();
        $client->role = (Role::SUPPORT)->value;

        $service = new SupportRequestService($repository);
        $request = new Request();
        $this->expectException(UnauthorizedException::class);
        $service->getAllFromClient($client, $request);
    }
    public function test_should_get_client_requestservice_if_role_is_client()
    {
        $supportRequest = new SupportRequest();
        $supportRequest->title = "title";
        $supportRequest->type = "type";
        $supportRequest->urgency = "urgency";
        $supportRequest->status = (SupportRequestStatus::PENDENT)->value;
        $supportRequest->client_id = 123;
        $supportRequest->message = "message";
        $supportRequest->print = null;

        $repository = $this->createMock(ISupportRequestRepository::class);
        $repository->method('getAllFromClient')
            ->willReturn([$supportRequest]);

        $client = new User();
        $client->id = 1;
        $client->role = (Role::CLIENT)->value;

        $service = new SupportRequestService($repository);
        $request = new Request();
        $data = $service->getAllFromClient($client, $request);
        $this->assertEquals(1, count($data));
    }
    public function test_should_not_finish_client_requestservice_if_role_is_not_client()
    {
        $repository = $this->createMock(ISupportRequestRepository::class);

        $client = new User();
        $client->role = (Role::SUPPORT)->value;

        $service = new SupportRequestService($repository);

        $this->expectException(UnauthorizedException::class);
        $service->clientFinishSupporRequest($client, 1);
    }
    public function test_should_not_finish_client_requestservice_if_supportrequest_is_not_founded()
    {
        $repository = $this->createMock(ISupportRequestRepository::class);
        $repository->method('getOneFromClient')
            ->willReturn(null);

        $client = new User();
        $client->id = 1;
        $client->role = (Role::CLIENT)->value;

        $service = new SupportRequestService($repository);

        $this->expectException(ModelNotFoundException::class);
        $service->clientFinishSupporRequest($client, 1);
    }
    public function test_should_not_finish_client_supportrequest_if_supportrequest_status_is_not_valid()
    {
        $supportRequest = new SupportRequest();
        $supportRequest->title = "title";
        $supportRequest->type = "type";
        $supportRequest->urgency = "urgency";
        $supportRequest->status = (SupportRequestStatus::PENDENT)->value;
        $supportRequest->client_id = 123;
        $supportRequest->message = "message";
        $supportRequest->print = null;

        $repository = $this->createMock(ISupportRequestRepository::class);
        $repository->method('getOneFromClient')
            ->willReturn($supportRequest);

        $client = new User();
        $client->id = 1;
        $client->role = (Role::CLIENT)->value;

        $service = new SupportRequestService($repository);

        $this->expectException(DomainException::class);
        $service->clientFinishSupporRequest($client, 1);
    }
    public function test_should_finish_requestservice_if_data_is_correct()
    {
        $supportRequest = new SupportRequest();
        $supportRequest->title = "title";
        $supportRequest->type = "type";
        $supportRequest->urgency = "urgency";
        $supportRequest->status = (SupportRequestStatus::IN_PROGRESS)->value;
        $supportRequest->client_id = 123;
        $supportRequest->message = "message";
        $supportRequest->print = null;

        $supportRequestUpdated = new SupportRequest();
        $supportRequestUpdated->title = "title";
        $supportRequestUpdated->type = "type";
        $supportRequestUpdated->urgency = "urgency";
        $supportRequestUpdated->status = (SupportRequestStatus::FINISHED_BY_CLIENT)->value;
        $supportRequestUpdated->client_id = 123;
        $supportRequestUpdated->message = "message";
        $supportRequestUpdated->print = null;

        $repository = $this->createMock(ISupportRequestRepository::class);
        $repository->method('getOneFromClient')
            ->willReturn($supportRequest);

        $repository->method('update')
            ->willReturn($supportRequestUpdated);

        $client = new User();
        $client->id = 1;
        $client->role = (Role::CLIENT)->value;

        $service = new SupportRequestService($repository);

        $update = $service->clientFinishSupporRequest($client, 1);
        $this->assertEquals($update->status, (SupportRequestStatus::FINISHED_BY_CLIENT)->value);
    }
    public function test_should_get_client_requestservice_if_role_is_not_client()
    {
        $repository = $this->createMock(ISupportRequestRepository::class);

        $client = new User();
        $client->role = (Role::SUPPORT)->value;

        $service = new SupportRequestService($repository);

        $this->expectException(UnauthorizedException::class);
        $service->clientGetOne($client, 1);
    }
    public function test_should_not_get_client_requestservice_if_supportrequest_is_not_founded()
    {
        $repository = $this->createMock(ISupportRequestRepository::class);
        $repository->method('getOneFromClient')
            ->willReturn(null);

        $client = new User();
        $client->id = 1;
        $client->role = (Role::CLIENT)->value;

        $service = new SupportRequestService($repository);

        $this->expectException(ModelNotFoundException::class);
        $service->clientGetOne($client, 1);
    }
    public function test_should_not_get_all_requestservice_if_role_is_not_support()
    {
        $repository = $this->createMock(ISupportRequestRepository::class);

        $client = new User();
        $client->role = (Role::CLIENT)->value;

        $request = new Request();
        $service = new SupportRequestService($repository);

        $this->expectException(UnauthorizedException::class);
        $service->getAllAsSupport($client, $request);
    }
    public function test_support_should_not_get_requestservice_if_role_is_not_support()
    {
        $repository = $this->createMock(ISupportRequestRepository::class);

        $client = new User();
        $client->role = (Role::CLIENT)->value;

        $service = new SupportRequestService($repository);

        $this->expectException(UnauthorizedException::class);
        $service->supportGetAService($client, 1);
    }
    public function test_support_should_not_get_requestservice_if_supportrequest_is_not_found()
    {
        $repository = $this->createMock(ISupportRequestRepository::class);
        $repository->method('getOne')
            ->willReturn(null);

        $client = new User();
        $client->role = (Role::SUPPORT)->value;

        $service = new SupportRequestService($repository);

        $this->expectException(ModelNotFoundException::class);
        $service->supportGetAService($client, 1);
    }
    public function test_support_should_not_get_requestservice_if_supportrequest_status_is_invalid()
    {
        $supportRequest = new SupportRequest();
        $supportRequest->title = "title";
        $supportRequest->type = "type";
        $supportRequest->urgency = "urgency";
        $supportRequest->status = (SupportRequestStatus::IN_PROGRESS)->value;
        $supportRequest->client_id = 123;
        $supportRequest->message = "message";
        $supportRequest->print = null;

        $repository = $this->createMock(ISupportRequestRepository::class);
        $repository->method('getOne')
            ->willReturn($supportRequest);

        $client = new User();
        $client->role = (Role::SUPPORT)->value;

        $service = new SupportRequestService($repository);

        $this->expectException(DomainException::class);
        $service->supportGetAService($client, 1);
    }

    public function test_support_should_not_finish_client_requestservice_if_role_is_not_support()
    {
        $repository = $this->createMock(ISupportRequestRepository::class);

        $client = new User();
        $client->role = (Role::SUPPORT)->value;

        $service = new SupportRequestService($repository);

        $this->expectException(UnauthorizedException::class);
        $service->clientFinishSupporRequest($client, 1);
    }
    public function test_support_should_not_finish_client_requestservice_if_supportrequest_is_not_founded()
    {
        $repository = $this->createMock(ISupportRequestRepository::class);
        $repository->method('getOneFromClient')
            ->willReturn(null);

        $client = new User();
        $client->id = 1;
        $client->role = (Role::CLIENT)->value;

        $service = new SupportRequestService($repository);

        $this->expectException(ModelNotFoundException::class);
        $service->clientFinishSupporRequest($client, 1);
    }
    public function test_support_should_not_finish_client_supportrequest_if_supportrequest_status_is_not_valid()
    {
        $supportRequest = new SupportRequest();
        $supportRequest->title = "title";
        $supportRequest->type = "type";
        $supportRequest->urgency = "urgency";
        $supportRequest->status = (SupportRequestStatus::PENDENT)->value;
        $supportRequest->client_id = 123;
        $supportRequest->message = "message";
        $supportRequest->print = null;

        $repository = $this->createMock(ISupportRequestRepository::class);
        $repository->method('getOneFromClient')
            ->willReturn($supportRequest);

        $client = new User();
        $client->id = 1;
        $client->role = (Role::CLIENT)->value;

        $service = new SupportRequestService($repository);

        $this->expectException(DomainException::class);
        $service->clientFinishSupporRequest($client, 1);
    }
    public function test_support_should_finish_requestservice_if_data_is_correct()
    {
        $supportRequest = new SupportRequest();
        $supportRequest->title = "title";
        $supportRequest->type = "type";
        $supportRequest->urgency = "urgency";
        $supportRequest->status = (SupportRequestStatus::IN_PROGRESS)->value;
        $supportRequest->client_id = 123;
        $supportRequest->message = "message";
        $supportRequest->print = null;

        $supportRequestUpdated = new SupportRequest();
        $supportRequestUpdated->title = "title";
        $supportRequestUpdated->type = "type";
        $supportRequestUpdated->urgency = "urgency";
        $supportRequestUpdated->status = (SupportRequestStatus::FINISHED_BY_SUPPORT)->value;
        $supportRequestUpdated->client_id = 123;
        $supportRequestUpdated->message = "message";
        $supportRequestUpdated->print = null;

        $repository = $this->createMock(ISupportRequestRepository::class);
        $repository->method('getOneFromClient')
            ->willReturn($supportRequest);

        $repository->method('update')
            ->willReturn($supportRequestUpdated);

        $client = new User();
        $client->id = 1;
        $client->role = (Role::CLIENT)->value;

        $service = new SupportRequestService($repository);

        $update = $service->clientFinishSupporRequest($client, 1);
        $this->assertEquals($update->status, (SupportRequestStatus::FINISHED_BY_SUPPORT)->value);
    }

    public function test_support_should_get_client_requestservice_if_role_is_not_support()
    {
        $repository = $this->createMock(ISupportRequestRepository::class);

        $client = new User();
        $client->role = (Role::CLIENT)->value;

        $service = new SupportRequestService($repository);

        $this->expectException(UnauthorizedException::class);
        $service->supportGetOne($client, 1);
    }
    public function test_support_should_not_get_client_requestservice_if_supportrequest_is_not_founded()
    {
        $repository = $this->createMock(ISupportRequestRepository::class);
        $repository->method('getOneFromClient')
            ->willReturn(null);

        $client = new User();
        $client->id = 1;
        $client->role = (Role::SUPPORT)->value;

        $service = new SupportRequestService($repository);

        $this->expectException(ModelNotFoundException::class);
        $service->supportGetOne($client, 1);
    }
}
