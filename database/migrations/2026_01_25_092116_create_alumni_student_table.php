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
        Schema::create('alumni_student', function (Blueprint $table) {
            $table->id();

            $table->string('s_id')->unique(); // รหัสนักศึกษา
            $table->string('first_name');
            $table->string('last_name');

            $table->foreignId('major_id')
                ->constrained('majors')
                ->cascadeOnDelete();

            $table->foreignId('alumni_project_id')
                ->constrained('alumni_project')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni_student');
    }
};
