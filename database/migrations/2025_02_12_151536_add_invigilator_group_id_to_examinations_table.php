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
        Schema::table('examination', function (Blueprint $table) {
            $table->unsignedBigInteger('inv_group_id')->after('type'); // Adjust placement as needed
        });
    }

    public function down()
    {
        Schema::table('examination', function (Blueprint $table) {
            $table->dropColumn('inv_group_id');
        });
    }
};
