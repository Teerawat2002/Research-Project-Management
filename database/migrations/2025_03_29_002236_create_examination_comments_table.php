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
        Schema::create('examination_comments', function (Blueprint $table) {
            $table->id();  // สร้าง field id (Primary Key)
            $table->bigInteger('examination_id')->unsigned();  // รหัสการสอบ
            $table->bigInteger('commenter_id')->unsigned();    // รหัสผู้ให้ความคิดเห็น (กรรมการหรืออาจารย์ที่ปรึกษา)
            $table->string('commenter_type');                    // ประเภทของผู้ให้ความคิดเห็น ('invigilator' หรือ 'advisor')
            $table->text('comment');                           // ความคิดเห็น
            
            $table->timestamps();  // ฟิลด์ created_at, updated_at
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examination_comments');
    }
};
