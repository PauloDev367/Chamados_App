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
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
    public function getAllFromClient(User $client)
    {
        if ($client->role != (Role::CLIENT)->value) {
            throw new UnauthorizedException("Unauthorized action");
        }

        return $this->repository->getAllFromClient($client->id);
    }

    public function clientFinishSupporRequest(User $client, int $supportRequestId)
    {
        if ($client->role != (Role::CLIENT)->value) {
            throw new UnauthorizedException("Unauthorized action");
        }

        $supportRequest = $this->repository->getOneFromClient($supportRequestId, $client->id);
        if ($supportRequest == null) {
            throw new ModelNotFoundException("Support request not founded");
        }

        if (
            $supportRequest->status == (SupportRequestStatus::PENDENT)->value ||
            $supportRequest->status == (SupportRequestStatus::FINISHED_BY_CLIENT)->value ||
            $supportRequest->status == (SupportRequestStatus::FINISHED_BY_SUPPORT)->value
        ) {
            throw new DomainException("To finish support request, they need to be in " . (SupportRequestStatus::IN_PROGRESS)->value . " status");
        }

        $supportRequest->status = (SupportRequestStatus::FINISHED_BY_CLIENT)->value;
        $update = $this->repository->update($supportRequest);
        return $update;
    }
}
