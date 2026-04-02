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
        Schema::create('shop_info_tabs', function (Blueprint $table) {
            $table->id();
            $table->morphs('model');
            $table->string('slug')->nullable();
            $table->jsonb('title')->nullable();
            $table->jsonb('content_schema')->nullable();
            $table->jsonb('content')->nullable();
            $table->integer('order')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_info_tabs');
    }
};
