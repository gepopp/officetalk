<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('officetalk_episode_topic', function (Blueprint $table): void {
            $table->foreignId('episode_id')
                ->constrained('officetalk_episodes')
                ->cascadeOnDelete();

            $table->foreignId('topic_id')
                ->constrained('officetalk_topics')
                ->cascadeOnDelete();

            $table->primary(['episode_id', 'topic_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('officetalk_episode_topic');
    }
};
