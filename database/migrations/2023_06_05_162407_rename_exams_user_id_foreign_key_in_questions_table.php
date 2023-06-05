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
        Schema::table('questions', function (Blueprint $table) {
            DB::statement('ALTER TABLE questions DROP FOREIGN KEY exams_user_id_foreign');
            DB::statement('ALTER TABLE questions ADD CONSTRAINT questions_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            DB::statement('ALTER TABLE questions DROP FOREIGN KEY questions_user_id_foreign');
            DB::statement('ALTER TABLE questions ADD CONSTRAINT exams_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id)');
        });
    }
};
