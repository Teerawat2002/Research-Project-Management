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
        Schema::create('revision_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('revision_id'); // ฟิลด์ revision_id ที่เชื่อมกับ revision
            $table->string('status'); // ฟิลด์ approval_status เพื่อบันทึกสถานะการอนุมัติ
            $table->text('comment')->nullable(); // ฟิลด์ comment สำหรับบันทึกความคิดเห็นการอนุมัติ (อาจเป็น null ได้)
            $table->unsignedBigInteger('approved_by'); // ฟิลด์ approved_by เก็บ ID ของผู้อนุมัติ
            $table->string('role'); // ฟิลด์ role เพื่อเก็บบทบาทของผู้อนุมัติ เช่น 'advisor', 'invigilator'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revision_histories');
    }
};
