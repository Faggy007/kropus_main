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
        Schema::create('shop_categories', function (Blueprint $table) {
            $table->id();
            $table->jsonb('title')->nullable();
            $table->jsonb('description')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('shop_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('shop_categories')->onDelete('set null');
            $table->string('slug')->unique();
            $table->jsonb('title')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::create('shop_product_variants', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->foreignId('product_id')->nullable()->constrained('shop_products')->onDelete('cascade');
            $table->jsonb('title')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::create('shop_units', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->jsonb('title')->nullable();
            $table->jsonb('short_title')->nullable();
            $table->timestamps();
        });

        Schema::create('shop_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('type')->nullable();
            $table->jsonb('title')->nullable();
            $table->foreignId('unit_id')->nullable()->constrained('shop_units')->onDelete('restrict');
            $table->timestamps();
        });

        Schema::create('shop_attribute_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_id')->nullable()->constrained('shop_attributes')->onDelete('cascade');
            $table->string('slug')->unique();
            $table->jsonb('title')->nullable();
            $table->timestamps();
        });

        Schema::create('shop_model_attributes', function (Blueprint $table) {
            $table->id();
            $table->morphs('model');
            $table->foreignId('attribute_id')->nullable()->constrained('shop_attributes')->onDelete('cascade');
            $table->foreignId('option_id')->nullable()->constrained('shop_attribute_options')->onDelete('cascade');
            $table->jsonb('text_value')->nullable();
            $table->double('numeric_value')->nullable();
            $table->integer('order')->nullable();
            $table->timestamps();
        });

        Schema::create('shop_modifiers', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->jsonb('title')->nullable();
            $table->timestamps();
        });

        Schema::create('shop_modifier_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modifier_id')->nullable()->constrained('shop_modifiers')->onDelete('cascade');
            $table->string('slug')->unique();
            $table->jsonb('title')->nullable();
            $table->integer('order')->nullable();
            $table->timestamps();
        });

        Schema::create('shop_model_modifiers', function (Blueprint $table) {
            $table->id();
            $table->morphs('model');
            $table->foreignId('modifier_id')->nullable()->constrained('shop_modifiers')->onDelete('cascade');
            $table->integer('order')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_model_modifiers');
        Schema::dropIfExists('shop_modifier_options');
        Schema::dropIfExists('shop_modifiers');
        Schema::dropIfExists('shop_model_attributes');
        Schema::dropIfExists('shop_attribute_options');
        Schema::dropIfExists('shop_attributes');
        Schema::dropIfExists('shop_units');
        Schema::dropIfExists('shop_product_variants');
        Schema::dropIfExists('shop_products');
        Schema::dropIfExists('shop_categories');
    }
};
