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
        Schema::dropIfExists('member_grade_detail');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
