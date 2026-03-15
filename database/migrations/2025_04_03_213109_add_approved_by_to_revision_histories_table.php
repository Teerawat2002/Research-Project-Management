<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('revision_histories', function (Blueprint $table) {
            // เพิ่มฟิลด์ approved_by เก็บ ID ของผู้อนุมัติ
            $table->unsignedBigInteger('evaluator_id')->nullable()->after('revision_id');

            // เพิ่ม foreign key constraint ถ้าจำเป็น (เชื่อมกับตาราง users หรืออื่นๆ)
            // $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('revision_histories', function (Blueprint $table) {
            // ลบฟิลด์ approved_by ถ้าต้องการ rollback
            $table->dropColumn('evaluator_id');
        });
    }
};
