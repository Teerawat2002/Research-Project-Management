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
        Schema::create('member_grade_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('group_member_id');
            $table->unsignedBigInteger('grader_id');
            $table->string('grade', 10)->nullable();
            $table->string('comment', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_grade_detail');
    }
};
