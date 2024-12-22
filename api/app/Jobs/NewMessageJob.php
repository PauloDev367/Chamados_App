<?php

namespace App\Jobs;

use App\Mail\NewMessageMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class NewMessageJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly User $fromMessage,
        private readonly User $toMessage
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->toMessage->email)
            ->send(new NewMessageMail(
                $this->fromMessage->name,
                $this->fromMessage->email,
                $this->toMessage->name,
                $this->toMessage->email,
            ));
    }
}
