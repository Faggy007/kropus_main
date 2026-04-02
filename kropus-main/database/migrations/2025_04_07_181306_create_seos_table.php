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
        Schema::create('seos', function (Blueprint $table) {
            $table->id();
            $table->morphs('model');
            $table->jsonb('title')->nullable();
            $table->jsonb('description')->nullable();
            $table->string('image')->nullable();
            $table->jsonb('og_title')->nullable();
            $table->jsonb('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->jsonb('robots')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seos');
    }
};
