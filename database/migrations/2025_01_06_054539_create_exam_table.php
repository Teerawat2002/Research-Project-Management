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
        Schema::create('exam_submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('propose_id'); // รหัสข้อเสนอ (foreign key)
            $table->integer('attempt'); // ครั้งที่สอบ
            $table->string('file_path')->nullable(); // เก็บ path ของไฟล์
            $table->string('status'); // สถานะที่เปลี่ยนแปลง (approved/rejected)
            $table->text('comments')->nullable(); // ความเห็น (optional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam');
    }
};
