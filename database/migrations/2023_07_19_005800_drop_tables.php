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
        Schema::dropIfExists('cities');
        Schema::dropIfExists('currencies');
        Schema::dropIfExists('exam_slots');

        Schema::dropIfExists('fee_invoice_records');
        Schema::dropIfExists('fee_invoices');
        Schema::dropIfExists('fees');
        Schema::dropIfExists('fee_categories');

        Schema::dropIfExists('notices');
        Schema::dropIfExists('personal_access_tokens');
        Schema::dropIfExists('states');

        Schema::dropIfExists('subject_user');
        Schema::dropIfExists('subjects');

        Schema::dropIfExists('timezones');
        Schema::dropIfExists('weekdays');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
