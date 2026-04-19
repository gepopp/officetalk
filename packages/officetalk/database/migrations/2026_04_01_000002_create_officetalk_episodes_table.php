<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('officetalk_episodes', function (Blueprint $table): void {
            $table->id();
            $table->unsignedInteger('number')->unique();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('eyebrow')->nullable();
            $table->text('abstract');
            $table->text('lead_quote')->nullable();

            $table->foreignId('guest_id')
                ->constrained('officetalk_guests')
                ->cascadeOnDelete();

            $table->string('vimeo_id')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('spotify_url')->nullable();
            $table->longText('transcript_markdown')->nullable();

            $table->string('still_landscape');
            $table->string('still_square')->nullable();
            $table->string('thumbnail_linkedin')->nullable();

            $table->unsignedSmallInteger('duration_minutes')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_featured')->default(false);

            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();

            $table->timestamps();

            $table->index('published_at');
            $table->index(['is_featured', 'published_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('officetalk_episodes');
    }
};
