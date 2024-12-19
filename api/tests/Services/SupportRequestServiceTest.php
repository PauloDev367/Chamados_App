<?php

namespace Services;

use App\Enums\Role;
use Tests\TestCase;
use App\Models\User;
use App\Services\SupportRequestService;
use App\Http\Requests\V1\CreateSupportRequestRequest;
use Illuminate\Validation\UnauthorizedException;

class SupportRequestServiceTest extends TestCase
{
    public function test_should_not_create_support_requestservice_if_user_role_is_no_client()
    {
        $client = new User();
        $client->role = (Role::SUPPORT)->value;
        $request = new \App\Http\Requests\V1\CreateSupportRequestRequest();
        $request->merge([
            'user_role' => 'non_client',
        ]);

        $service = new SupportRequestService();

        $this->expectException(UnauthorizedException::class);
        $service->create($client, $request);
    }
}
