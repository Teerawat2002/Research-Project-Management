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
        Schema::create('exam_submission_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_submission_id');
            $table->string('status')->comment('สถานะของการส่ง เช่น pending, approved, rejected');
            $table->text('comments')->nullable()->comment('ความคิดเห็นจากผู้ตรวจ');
            $table->timestamp('changed_at')->useCurrent()->comment('เวลาที่เปลี่ยนแปลง');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_submission_histories');
    }
};
