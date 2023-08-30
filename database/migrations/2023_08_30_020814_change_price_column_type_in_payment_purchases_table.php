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
        Schema::table('payment_purchases', function (Blueprint $table) {
            $table->decimal('course_amount', 10, 2)->change();
            $table->decimal('paid_amount', 10, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_purchases', function (Blueprint $table) {
            $table->integer('course_amount')->change();
            $table->integer('paid_amount')->change();
        });
    }
};
