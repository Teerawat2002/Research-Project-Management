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
        Schema::create('exam_grade', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('submission_id');
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('exam_invi_id');
            $table->string('grade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_grade');
    }
};
