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
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
            $table->string('restaurant_name')->default('DinePro');
            $table->string('logo')->nullable();
            $table->string('primary_color')->default('#f97316'); // Orange-500
            $table->string('hero_title')->default('Welcome to DinePro');
            $table->string('hero_subtitle')->nullable();
            $table->text('about_text')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('theme_name')->default('default');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_settings');
    }
};
