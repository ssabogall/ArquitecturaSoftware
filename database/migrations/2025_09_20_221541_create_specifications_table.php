<?php

/**
 * Migration: Create Specifications Table
 *
 * Crea la tabla 'specifications' con los campos técnicos del dispositivo.
 * Relación 1–1: MobilePhone hasOne Specification y la FK vive en specifications.mobile_phone_id
 *
 * @author Miguel Arcila
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('specifications', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->string('processor');
            $table->integer('battery');
            $table->float('screen_size');
            $table->string('screen_tech');
            $table->integer('ram');
            $table->integer('storage');
            $table->string('camera_specs');
            $table->string('color');

            // Relación 1–1 con mobile_phones (FK vive en specifications)
            $table->unsignedBigInteger('mobile_phone_id')->unique();
            $table->foreign('mobile_phone_id')
                ->references('id')
                ->on('mobile_phones')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('specifications');
    }
};
