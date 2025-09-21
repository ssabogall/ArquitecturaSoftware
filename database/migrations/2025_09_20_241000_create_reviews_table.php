<?php

/**
 * Migration: Create Reviews Table
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('mobile_phone_id');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->integer('rating');
            $table->string('comments')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('mobile_phone_id')->references('id')->on('mobile_phones')->cascadeOnDelete();
            $table->index(['user_id', 'mobile_phone_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
