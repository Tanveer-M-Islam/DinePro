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
        Schema::table('website_settings', function (Blueprint $table) {
            $table->text('footer_text')->nullable()->after('about_text');
            $table->string('facebook_link')->nullable()->after('address');
            $table->string('instagram_link')->nullable()->after('facebook_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('website_settings', function (Blueprint $table) {
            $table->dropColumn(['footer_text', 'facebook_link', 'instagram_link']);
        });
    }
};
