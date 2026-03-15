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
        Schema::create('propose_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('propose_id'); // รหัสข้อเสนอ (foreign key)
            $table->string('status'); // สถานะที่เปลี่ยนแปลง (approved/rejected)
            $table->text('comments')->nullable(); // ความเห็น (optional)
            $table->timestamp('changed_at')->useCurrent(); // วันเวลาที่มีการเปลี่ยนแปลงสถานะ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propose_histories');
    }
};
