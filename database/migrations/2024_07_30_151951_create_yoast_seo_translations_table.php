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
        Schema::create('yoast_seo_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('yoast_seo_id')->constrained('yoast_seos')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->text('seo_keywords')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yoast_seo_translations');
    }
};
