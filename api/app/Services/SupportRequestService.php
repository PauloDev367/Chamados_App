<?php

namespace App\Services;

use App\Enums\Role;
use App\Models\User;
use DomainException;
use App\Models\SupportRequest;
use App\Enums\SupportRequestStatus;
use App\Services\Ports\ISupportRequestService;
use Illuminate\Validation\UnauthorizedException;
use App\Http\Requests\V1\CreateSupportRequestRequest;
use App\Repositories\Ports\ISupportRequestRepository;

class SupportRequestService implements ISupportRequestService
{
    public function __construct(
        private readonly ISupportRequestRepository $repository
    ) {}

    public function create(User $client, CreateSupportRequestRequest $request)
    {
        if ($client->role != (Role::CLIENT)->value) {
            throw new UnauthorizedException("Unauthorized action");
        }

        $filePath = null;
        if ($request->hasFile("print")) {
            $image = $request->file("print");
            $filePath = $image->store("public/uploads/formrequest");
        }

        $supportRequest = new SupportRequest();
        $supportRequest->title = $request->title;
        $supportRequest->type = $request->type;
        $supportRequest->urgency = $request->urgency;
        $supportRequest->status = (SupportRequestStatus::PENDENT)->value;
        $supportRequest->client_id = $client->id;
        $supportRequest->message = $request->message;
        $supportRequest->print = $filePath;

        $this->repository->create($supportRequest);
        return $supportRequest;
    }
}
