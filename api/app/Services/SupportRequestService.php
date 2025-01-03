<?php

namespace App\Services;

use App\Enums\Role;
use App\Models\User;
use DomainException;
use App\Enums\MessageStatus;
use Illuminate\Http\Request;
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
        $supportRequest->supportrequest_chat_status = (MessageStatus::NO_MESSAGES)->value;
        $supportRequest->client_email = $client->email;

        $this->repository->create($supportRequest);
        return $supportRequest;
    }
    public function getAllFromClient(User $client, Request $request)
    {
        if ($client->role != (Role::CLIENT)->value) {
            throw new UnauthorizedException("Unauthorized action");
        }

        return $this->repository->getAllFromClient($client->id, $request);
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

    public function clientGetOne(User $client, int $id)
    {
        if ($client->role != (Role::CLIENT)->value) {
            throw new UnauthorizedException("Unauthorized action");
        }

        $supportRequest = $this->repository->getOneFromClient($id, $client->id);
        if ($supportRequest == null) {
            throw new ModelNotFoundException("Support request not founded");
        }

        return $supportRequest;
    }

    public function getAllAsSupport(User $support, Request $request)
    {
        if ($support->role != (Role::SUPPORT)->value) {
            throw new UnauthorizedException("Unauthorized action");
        }

        $data = $this->repository->getAll($request, $support);
        return $data;
    }

    public function supportGetAService(User $support, int $id)
    {
        if ($support->role != (Role::SUPPORT)->value) {
            throw new UnauthorizedException("Unauthorized action");
        }

        $supportRequest = $this->repository->getOne($id);
        if ($supportRequest == null) {
            throw new ModelNotFoundException("Support request not founded");
        }

        if ($supportRequest->status != (SupportRequestStatus::PENDENT)->value) {
            throw new DomainException("This support request already have a support");
        }

        $supportRequest->support_id = $support->id;
        $supportRequest->status = (SupportRequestStatus::IN_PROGRESS)->value;
        $supportRequest->save();
        return $supportRequest;
    }

    public function supportFinishService(User $support, int $id)
    {

        if ($support->role != (Role::SUPPORT)->value) {
            throw new UnauthorizedException("Unauthorized action");
        }

        $supportRequest = $this->repository->getOne($id, $support->id);
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
        $supportRequest->status = (SupportRequestStatus::FINISHED_BY_SUPPORT)->value;
        $update = $this->repository->update($supportRequest);
        return $update;
    }

    public function supportGetOne(User $support, int $id)
    {
        if ($support->role != (Role::SUPPORT)->value) {
            throw new UnauthorizedException("Unauthorized action");
        }

        $supportRequest = $this->repository->getOne($id);
        if ($supportRequest == null) {
            throw new ModelNotFoundException("Support request not founded");
        }

        return $supportRequest;
    }
}
