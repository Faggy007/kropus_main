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
        Schema::create('shop_gallery', function (Blueprint $table) {
            $table->id();
            $table->morphs('model');
            $table->timestamps();
        });

        Schema::create('shop_gallery_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gallery_id')->constrained('shop_gallery')->onDelete('cascade');
            $table->string('type')->nullable();
            $table->string('image')->nullable();
            $table->string('preview_image')->nullable();
            $table->string('video')->nullable();
            $table->string('iframe')->nullable();
            $table->integer('order')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_gallery_items');
        Schema::dropIfExists('shop_gallery');
    }
};
