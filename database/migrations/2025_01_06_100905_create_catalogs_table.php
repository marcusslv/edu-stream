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
        Schema::create('catalogs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index();
            $table->text('description')->nullable();
            $table->morphs('catalogable');
            $table->timestamps();
        });

        Schema::create('catalog_video', function (Blueprint $table) {
            $table->id();
            $table->foreignId('catalog_id')->constrained('catalogs');
            $table->foreignId('video_id')->constrained('videos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalog_video');
        Schema::dropIfExists('catalogs');
    }
};
