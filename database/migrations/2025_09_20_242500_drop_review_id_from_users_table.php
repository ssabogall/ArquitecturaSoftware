<?php

/**
 * Migration: Drop review_id From Users Table
 *
 * Elimina la columna huérfana users.review_id que no se utiliza.
 *
 * @author Miguel Arcila
 *
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('users', 'review_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('review_id');
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasColumn('users', 'review_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->unsignedBigInteger('review_id')->nullable();
            });
        }
    }
};
