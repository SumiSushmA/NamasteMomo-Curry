<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gift_card_occasions', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('headline');
            $table->string('emoji', 8)->nullable();
            $table->string('bg_start', 20)->nullable();
            $table->string('bg_mid', 20)->nullable();
            $table->string('bg_end', 20)->nullable();
            $table->string('text_color', 20)->nullable();
            $table->foreignId('gift_card_design_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::table('gift_cards', function (Blueprint $table) {
            $table->string('occasion', 60)->nullable()->after('gift_card_design_id');
        });
    }

    public function down(): void
    {
        Schema::table('gift_cards', function (Blueprint $table) {
            $table->dropColumn('occasion');
        });

        Schema::dropIfExists('gift_card_occasions');
    }
};
