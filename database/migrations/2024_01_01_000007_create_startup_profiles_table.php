<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('startup_profiles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('startup_id')->unique();
            $table->text('pitch_deck_url')->nullable();
            $table->text('video_pitch_url')->nullable();
            $table->text('story')->nullable();
            $table->text('achievements')->nullable();
            $table->string('social_twitter')->nullable();
            $table->string('social_linkedin')->nullable();
            $table->string('social_github')->nullable();
            $table->string('social_instagram')->nullable();
            $table->decimal('monthly_revenue', 15, 2)->nullable();
            $table->decimal('mrr_growth_rate', 5, 2)->nullable();
            $table->integer('active_users')->nullable();
            $table->integer('customer_count')->nullable();
            $table->integer('employees_count')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('startup_id')->references('id')->on('startups')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('startup_profiles');
    }
};
