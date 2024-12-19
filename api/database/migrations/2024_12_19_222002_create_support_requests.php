<?php

use App\Enums\SupportRequestStatus;
use App\Enums\SupportRequestType;
use App\Enums\SupportRequestUrgency;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('support_requests', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->enum('type', [
                (SupportRequestType::TECHNICAL)->value,
                (SupportRequestType::FINANCIAL)->value,
                (SupportRequestType::OTHER)->value,
            ]);
            $table->enum('urgency', [
                (SupportRequestUrgency::LOW)->value,
                (SupportRequestUrgency::MEDIUM)->value,
                (SupportRequestUrgency::URGENCY)->value,
            ]);
            $table->enum('status', [
                (SupportRequestStatus::PENDENT)->value,
                (SupportRequestStatus::IN_PROGRESS)->value,
                (SupportRequestStatus::FINISHED_BY_CLIENT)->value,
                (SupportRequestStatus::FINISHED_BY_SUPPORT)->value,
            ]);
            $table->unsignedTinyInteger('client_id');
            $table->unsignedTinyInteger('support_id')->nullable(true)->default(null);
            $table->text('message');
            $table->text('print')->nullable(true)->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_requests');
    }
};
