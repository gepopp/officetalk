<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('officetalk_contact_requests', function (Blueprint $table): void {
            $table->id();
            $table->string('company');
            $table->string('contact_name');
            $table->string('email');
            $table->string('role');
            $table->text('occasion');
            $table->string('preferred_timing')->nullable();
            $table->string('confirmation_token', 64)->unique();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('summary_sent_at')->nullable();
            $table->timestamps();

            $table->index('email');
            $table->index('confirmed_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('officetalk_contact_requests');
    }
};
