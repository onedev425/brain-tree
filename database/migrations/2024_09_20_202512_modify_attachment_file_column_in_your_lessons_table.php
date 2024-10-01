<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->text('attachment_file')->change(); // Change the column to TEXT
        });
    }

    public function down()
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->string('attachment_file', 255)->change(); // Revert back to original if needed
        });
    }
};
