<?php

use App\Enums\MessageStatus;
use App\Enums\MessageType;
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
        Schema::table('messages', function (Blueprint $table) {
            $table->enum('status', [
                (MessageStatus::NO_MESSAGES)->value,
                (MessageStatus::WAITING_SUPPORT_RESPONSE)->value,
                (MessageStatus::WAITING_CLIENT_RESPONSE)->value,
            ]);
            $table->enum('type', [
                (MessageType::CLIENT)->value,
                (MessageType::SUPPORT)->value,
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('type');
        });
    }
};
