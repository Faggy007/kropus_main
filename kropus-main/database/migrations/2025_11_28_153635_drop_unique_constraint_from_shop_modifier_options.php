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
        Schema::table('shop_modifier_options', function (Blueprint $table) {
            $table->dropUnique('shop_modifier_options_slug_unique');
        });
    }
};
