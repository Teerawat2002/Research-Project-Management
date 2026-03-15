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
        Schema::create('examination', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('submission_id'); // รหัสข้อเสนอ (foreign key)
            $table->string('type'); // ประเภท
            $table->string('room'); // ห้องสอบ
            $table->date('date'); // วันที่สอบ
            $table->time('time'); // เวลา
            $table->string('status'); // สถานะที่เปลี่ยนแปลง (approved/rejected)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examination');
    }
};
