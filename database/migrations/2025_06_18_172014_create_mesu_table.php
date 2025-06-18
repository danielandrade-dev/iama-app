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
        Schema::create('mesus', function (Blueprint $table) {
            $table->id();
            $table->string('agency');
            $table->foreignId('user_id')->constrained('users');
            $table->string('functional');
            $table->foreignId('parent_mesu_id')->nullable()->constrained('mesus');
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mesus');
    }
};
