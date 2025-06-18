<?php

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
        Schema::create('transfer_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requester_mesu_id')->constrained('mesus');
            $table->foreignId('ceding_mesu_id')->constrained('mesus');
            $table->string('transfer_type');
            $table->string('status');
            $table->timestamp('requester_approval_at')->nullable();
            $table->timestamp('ceding_approval_at')->nullable();
            $table->timestamp('requester_rejection_at')->nullable();
            $table->timestamp('ceding_rejection_at')->nullable();
            $table->text('opening_observation')->nullable();
            $table->text('closing_observation')->nullable();
            $table->foreignId('ticket_id')->constrained('tickets');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer_requests');
    }
};
