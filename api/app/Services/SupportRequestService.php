<?php

namespace App\Services;

use App\Enums\Role;
use App\Models\User;
use App\Services\Ports\ISupportRequestService;
use App\Http\Requests\V1\CreateSupportRequestRequest;
use DomainException;
use Illuminate\Validation\UnauthorizedException;

class SupportRequestService implements ISupportRequestService
{

    public function __construct() {
    }
    public function create(User $client, CreateSupportRequestRequest $request)
    {
        if ($client->role != (Role::CLIENT)->value) {
            throw new UnauthorizedException("Unauthorized action");
        }
    }
}
