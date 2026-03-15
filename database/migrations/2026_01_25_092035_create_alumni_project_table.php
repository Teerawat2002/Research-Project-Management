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
        Schema::create('alumni_project', function (Blueprint $table) {
            $table->id();

            $table->string('title'); // ชื่อโครงงาน

            $table->foreignId('project_type_id')
                  ->constrained('project_type')
                  ->cascadeOnDelete();

            $table->string('keyword')->nullable();

            $table->foreignId('advisor_id')
                  ->constrained('advisors')
                  ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni_project');
    }
};
