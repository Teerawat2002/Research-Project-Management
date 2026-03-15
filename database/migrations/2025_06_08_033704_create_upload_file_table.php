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
        Schema::create('upload_file', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('upload_id');
            $table->string('cover_file');
            $table->string('project_file');
            $table->string('abstract_file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upload_file');
    }
};
