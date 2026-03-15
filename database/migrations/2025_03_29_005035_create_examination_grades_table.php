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
        Schema::create('examination_grades', function (Blueprint $table) {
            $table->id();  // สร้าง field id (Primary Key)
            $table->bigInteger('examination_id')->unsigned();  // รหัสการสอบ
            $table->bigInteger('group_member_id')->unsigned();     // รหัสนักศึกษา
            $table->bigInteger('evaluator_id')->unsigned();   // รหัสผู้ให้คะแนน (กรรมการหรืออาจารย์ที่ปรึกษา)
            $table->string('evaluator_type');                  // ประเภทของผู้ให้คะแนน ('invigilator' หรือ 'advisors')
            $table->string('grade');                           // คะแนนที่ให้
            $table->date('grade_date');                        // วันที่ให้คะแนน
            $table->string('status');                          // สถานะของคะแนน (เช่น 'ให้คะแนนแล้ว', 'ยังไม่ได้ให้คะแนน')
            
            $table->timestamps();  // ฟิลด์ created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examination_grades');
    }
};
