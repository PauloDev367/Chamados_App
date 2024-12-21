<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Ports\IMessageService;
use App\Http\Requests\AddMessageToSupportRequestRequest;

class MessagesController extends Controller
{
    public function __construct(
        private readonly IMessageService $service
    ) {}

    public function supportAdd(AddMessageToSupportRequestRequest $request)
    {
        $user = auth()->user();
        $data = $this->service->supportAddMessage($user, $request);
        return response()->json(['success' => $data], 201);
    }
    public function getAll(int $id)
    {
        $user = auth()->user();
        $data = $this->service->getAll($user, $id);
        return response()->json(['success' => $data], 200);
    }
}
