<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('startup_team_members', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('startup_id');
            $table->uuid('user_id')->nullable();
            $table->string('name');
            $table->string('position');
            $table->text('bio')->nullable();
            $table->text('avatar_url')->nullable();
            $table->string('email')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamps();

            // Foreign keys
            $table->foreign('startup_id')->references('id')->on('startups')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            // Indexes
            $table->index('startup_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('startup_team_members');
    }
};
