<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('officetalk_guests', function (Blueprint $table): void {
            $table->id();
            $table->string('slug')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('role');
            $table->string('company');
            $table->string('company_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('portrait');
            $table->text('bio_short')->nullable();
            $table->text('bio_long')->nullable();
            $table->timestamps();

            $table->index('last_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('officetalk_guests');
    }
};
