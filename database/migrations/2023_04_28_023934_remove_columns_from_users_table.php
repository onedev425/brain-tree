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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['gender', 'birthday', 'nationality', 'state', 'city', 'religion', 'blood_group', 'phone', 'address']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('gender')->nullable();
            $table->date('birthday');
            $table->string('nationality');
            $table->string('state');
            $table->string('city');
            $table->string('religion')->nullable();
            $table->string('blood_group');
            $table->string('phone')->nullable();
            $table->string('address');
        });
    }
};
