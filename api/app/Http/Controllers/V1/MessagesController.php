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

    public function supportAdd(AddMessageToSupportRequestRequest $request) {}
}
