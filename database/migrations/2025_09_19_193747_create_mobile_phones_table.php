<?php

/**
 * Migration: Create Mobile Phones Table
 *
 * Crea la tabla de teléfonos móviles para almacenar información sobre los productos.
 *
 * @author Alejandro Carmona
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mobile_phones', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo_url')->nullable();
            $table->string('brand');
            $table->integer('price')->unsigned();
            $table->integer('stock')->unsigned()->default(0);
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mobile_phones');
    }
};
