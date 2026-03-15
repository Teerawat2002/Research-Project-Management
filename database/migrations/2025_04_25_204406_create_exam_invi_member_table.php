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
        Schema::create('exam_invi_member', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('submission_id');
            $table->unsignedBigInteger('invi_member_id');
            // ถ้าต้องการเก็บสถานะการเชิญ หรือวันเวลาที่เชิญ ก็สามารถเพิ่มคอลัมน์ได้ เช่น:
            // $table->timestamp('invited_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_invi_member');
    }
};
