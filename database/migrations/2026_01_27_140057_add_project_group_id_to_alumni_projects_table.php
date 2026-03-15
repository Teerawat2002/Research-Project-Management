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
        Schema::table('alumni_project', function (Blueprint $table) {
            $table->foreignId('project_group_id')
                ->nullable()
                ->after('keyword') // หรือ after('project_type_id')
                ->constrained('project_groups')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('alumni_project', function (Blueprint $table) {
            $table->dropForeign(['project_group_id']);
            $table->dropColumn('project_group_id');
        });
    }
};
