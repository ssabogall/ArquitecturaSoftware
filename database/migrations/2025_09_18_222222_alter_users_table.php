<?php

/**
 * Migration: Alter Users Table
 *
 * Añade campos adicionales a la tabla de usuarios.
 *
 * @author Alejandro Carmona
 */

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
            $table->boolean('staff')->default(false);
            $table->integer('phone')->nullable();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('review_id')->nullable(); // review sin FK (hasta crear la tabla reviews)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['staff', 'phone', 'address', 'review_id']);
        });
    }
};
