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
        DB::statement("ALTER TABLE questions MODIFY COLUMN type ENUM('multi', 'single', 'boolean')");
        Schema::table('questions', function (Blueprint $table) {
            $table->integer('points')->after('type')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('points');
        });
        DB::statement("ALTER TABLE questions MODIFY COLUMN type ENUM('multiple', 'single', 'true-false')");
    }
};
