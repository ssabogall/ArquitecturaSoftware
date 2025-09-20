<?php

/**
 * Migration: Alter Users Phone To String
 *
 * Cambia el tipo de dato del campo 'phone' en la tabla de usuarios a VARCHAR.
 *
 * @author Alejandro Carmona
 *
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE `users` MODIFY `phone` VARCHAR(30) NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE `users` MODIFY `phone` INT NULL');
    }
};
