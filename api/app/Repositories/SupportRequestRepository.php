<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SupportRequest;
use App\Enums\SupportRequestStatus;
use App\Repositories\Ports\ISupportRequestRepository;

class SupportRequestRepository implements ISupportRequestRepository
{
    public function create(SupportRequest $supportRequest)
    {
        $supportRequest->save();
        return $supportRequest;
    }
    public function getAllFromClient(int $clientId, Request $request)
    {
        $query =  SupportRequest::query();

        if ($request->has("supportrequest_status")) {
            $status = $request->query("supportrequest_status");
            if (
                $status == (SupportRequestStatus::FINISHED_BY_CLIENT)->value ||
                $status == (SupportRequestStatus::FINISHED_BY_SUPPORT)->value
            ) {
                $query->whereIn("status", [
                    (SupportRequestStatus::FINISHED_BY_CLIENT)->value,
                    (SupportRequestStatus::FINISHED_BY_SUPPORT)->value,
                ]);
            } else {
                $query->where("status", $status);
            }
        }

        return $query->where("client_id", $clientId)
            ->paginate(10);
    }
    public function getAll(Request $request, User $support)
    {
        $query = SupportRequest::query();

        if ($request->has("supportrequest_status")) {
            $status = $request->query("supportrequest_status");
            if (
                $status == (SupportRequestStatus::FINISHED_BY_CLIENT)->value ||
                $status == (SupportRequestStatus::FINISHED_BY_SUPPORT)->value
            ) {
                $query->whereIn("status", [
                    (SupportRequestStatus::FINISHED_BY_CLIENT)->value,
                    (SupportRequestStatus::FINISHED_BY_SUPPORT)->value,
                ]);
            } else {

                $query->where("status", $status);
            }

            if (
                $status == (SupportRequestStatus::IN_PROGRESS)->value ||
                $status == (SupportRequestStatus::FINISHED_BY_CLIENT)->value ||
                $status == (SupportRequestStatus::FINISHED_BY_SUPPORT)->value
            ) {
                $query->where("support_id", $support->id);
            }
        }

        return $query->paginate(10);
    }
    public function update(SupportRequest $supportRequest)
    {
        $supportRequest->save();
        return $supportRequest;
    }
    public function getOneFromClient(int $supportRequestId, int $clientId)
    {
        return SupportRequest::where('id', $supportRequestId)
            ->where("client_id", $clientId)
            ->first();
    }
    public function getOne(int $supportRequestId)
    {
        return SupportRequest::where('id', $supportRequestId)
            ->first();
    }
}
