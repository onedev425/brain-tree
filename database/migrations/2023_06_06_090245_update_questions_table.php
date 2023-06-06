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
        DB::statement('ALTER TABLE questions DROP FOREIGN KEY exams_subject_id_foreign');
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('subject_id');
            $table->dropColumn('active');
            $table->foreignId('course_id')->after('user_id')->nullable()->constrained()->nullOnDelete()->onUpdate('cascade');

            DB::statement('ALTER TABLE questions DROP FOREIGN KEY exams_user_id_foreign');
            DB::statement('ALTER TABLE questions ADD CONSTRAINT questions_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE questions ADD CONSTRAINT exams_subject_id_foreign FOREIGN KEY (subject_id) REFERENCES subjects(id)');
        Schema::table('questions', function (Blueprint $table) {
            DB::statement('ALTER TABLE questions DROP FOREIGN KEY questions_user_id_foreign');
            DB::statement('ALTER TABLE questions ADD CONSTRAINT exams_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id)');

            $table->dropForeign(['course_id']);
            $table->dropColumn('course_id');
            $table->boolean('active')->default(false);
            $table->unsignedBigInteger('subject_id')->nullable();
        });
    }
};
