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
            $table->renameColumn('user_id', 'created_by');
            $table->renameColumn('subject_id', 'industry_id');
            $table->unsignedBigInteger('assigned_id')->after('user_id');
            $table->foreign('assigned_id')->references('id')->on('users');
            $table->boolean('quiz_active')->default(true)->after('subject_id');
            $table->boolean('is_published')->default(false)->after('subject_id');
            $table->integer('price')->default(0)->after('title');
            $table->softDeletes();
        });
        DB::statement('ALTER TABLE courses DROP FOREIGN KEY courses_subject_id_foreign');
        DB::statement('ALTER TABLE courses ADD CONSTRAINT courses_industry_id_foreign FOREIGN KEY (industry_id) REFERENCES industries(id)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE courses DROP FOREIGN KEY courses_industry_id_foreign');
        DB::statement('ALTER TABLE courses ADD CONSTRAINT courses_subject_id_foreign FOREIGN KEY (subject_id) REFERENCES subjects(id)');

        Schema::table('courses', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn('price');
            $table->dropColumn('is_published');
            $table->dropColumn('quiz_active');
            $table->dropForeign(['assigned_id']);
            $table->dropColumn('assigned_id');
            $table->renameColumn('industry_id', 'subject_id');
            $table->renameColumn('created_by', 'user_id');
        });
    }
};
