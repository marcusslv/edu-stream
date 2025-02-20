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
        Schema::create('video_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('video_id')->constrained('videos');
            $table->string('file_name');
            $table->string('file_original_name');
            $table->string('file_path');
            $table->integer('file_size');
            $table->string('file_format');
            $table->string('file_extension');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_files');
    }
};
