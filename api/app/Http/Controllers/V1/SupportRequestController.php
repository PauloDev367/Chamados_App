<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CreateSupportRequestRequest;
use App\Services\Ports\ISupportRequestService;
use Illuminate\Http\Request;

class SupportRequestController extends Controller
{
    public function __construct(
        private readonly ISupportRequestService $service
    ) {}


    public function create(CreateSupportRequestRequest $request)
    {
        $user = auth()->user();
        $created = $this->service->create($user, $request);
        return response()->json(['success' => $created], 201);
    }

    public function getAllFromClient()
    {
        $user = auth()->user();
        $data = $this->service->getAllFromClient($user);
        return response()->json(['success' => $data], 200);
    }

    public function clientFinishSupporRequest(int $id)
    {
        $user = auth()->user();
        $data = $this->service->clientFinishSupporRequest($user, $id);
        return response()->json(['success' => $data]);
    }

    public function clientGetOneSupportRequest(int $id)
    {
        
    }
}
