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
        Schema::table('upload', function (Blueprint $table) {
            // เพิ่มคอลัมน์ revision_id โดยยังไม่ตั้ง foreign key
            $table->unsignedBigInteger('revision_id')
                ->nullable()
                ->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('upload', function (Blueprint $table) {
            // ลบคอลัมน์ revision_id
            $table->dropColumn('revision_id');
        });
    }
};
