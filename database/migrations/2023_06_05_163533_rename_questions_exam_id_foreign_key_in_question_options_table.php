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
        Schema::table('question_options', function (Blueprint $table) {
            DB::statement('ALTER TABLE question_options DROP FOREIGN KEY questions_exam_id_foreign');
            DB::statement('ALTER TABLE question_options ADD CONSTRAINT question_options_question_id_foreign FOREIGN KEY (question_id) REFERENCES questions(id)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('question_options', function (Blueprint $table) {
            DB::statement('ALTER TABLE question_options DROP FOREIGN KEY question_options_question_id_foreign');
            DB::statement('ALTER TABLE question_options ADD CONSTRAINT questions_exam_id_foreign FOREIGN KEY (question_id) REFERENCES questions(id)');
        });
    }
};
