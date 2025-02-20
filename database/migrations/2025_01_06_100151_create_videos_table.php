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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('duration');
            $table->date('release_date');
            $table->string('rating');
            $table->boolean('is_published')->default(false);
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('genre_id')->constrained('genres');
            $table->timestamps();
        });

        Schema::create('video_cast_member', function (Blueprint $table) {
            $table->id();
            $table->foreignId('video_id')->constrained('videos');
            $table->foreignId('cast_member_id')->constrained('cast_members');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_cast_member');
        Schema::dropIfExists('videos');
    }
};
