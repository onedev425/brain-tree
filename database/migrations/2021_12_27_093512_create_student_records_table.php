<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('student_records', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('admission_number')->nullable();
            $table->date('admission_date');
            $table->boolean('is_graduated')->default(false);
            $table->timestamps();
            //admission number unique
            $table->unique('admission_number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_records');
    }
};
