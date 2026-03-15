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
        Schema::dropIfExists('alumni_student');
    }

    public function down(): void
    {
        // เผื่อ rollback (ถ้าต้องการ)
        Schema::create('alumni_student', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }
};
