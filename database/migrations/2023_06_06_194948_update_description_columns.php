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
        Schema::table('courses', function (Blueprint $table) {
            $table->longText('description')->nullable()->change();
        });
        Schema::table('lessons', function (Blueprint $table) {
            $table->longText('description')->nullable()->change();
        });
        Schema::table('questions', function (Blueprint $table) {
            $table->longText('name')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->string('name')->change();
        });
        Schema::table('lessons', function (Blueprint $table) {
            $table->longText('description')->change();
        });
        Schema::table('courses', function (Blueprint $table) {
            $table->longText('description')->change();
        });

    }
};
