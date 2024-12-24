<?php

use App\Enums\MessageStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('support_requests', function (Blueprint $table) {
            $table->enum("supportrequest_chat_status", [
                (MessageStatus::NO_MESSAGES)->value,
                (MessageStatus::WAITING_SUPPORT_RESPONSE)->value,
                (MessageStatus::WAITING_CLIENT_RESPONSE)->value,
            ])->nullable(true)->default((MessageStatus::NO_MESSAGES)->value);
            $table->string("client_email")->nullable(true)->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('support_requests', function (Blueprint $table) {
            $table->dropColumn("supportrequest_chat_status");
            $table->dropColumn("client_email");
        });
    }
};
