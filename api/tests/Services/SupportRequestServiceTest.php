<?php

namespace Services;

use App\Enums\Role;
use Tests\TestCase;
use App\Models\User;
use App\Models\SupportRequest;
use App\Enums\SupportRequestStatus;
use App\Services\SupportRequestService;
use Illuminate\Validation\UnauthorizedException;
use App\Http\Requests\V1\CreateSupportRequestRequest;
use App\Repositories\Ports\ISupportRequestRepository;

class SupportRequestServiceTest extends TestCase
{
    public function test_should_not_create_support_requestservice_if_user_role_is_no_client()
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
    public function test_should_create_support_requestservice_if_user_role_is_client()
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
}
