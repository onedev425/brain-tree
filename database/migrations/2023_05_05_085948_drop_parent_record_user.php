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
        Schema::dropIfExists('parent_record_user');
        Schema::dropIfExists('parent_records');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
