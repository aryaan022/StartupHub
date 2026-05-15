<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('startups', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('founder_id');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('logo_url')->nullable();
            $table->text('banner_url')->nullable();
            $table->text('description');
            $table->string('short_description', 500)->nullable();
            $table->string('website_url')->nullable();
            $table->date('founded_at')->nullable();
            $table->string('industry');
            $table->string('sub_industry')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->enum('stage', ['idea', 'pre_seed', 'seed', 'series_a', 'series_b', 'series_c', 'growth', 'exit'])->nullable();
            $table->decimal('funding_goal', 15, 2)->nullable();
            $table->decimal('total_raised', 15, 2)->default(0);
            $table->integer('team_size')->nullable();
            $table->boolean('is_hiring')->default(false);
            $table->boolean('is_verified')->default(false);
            $table->enum('visibility', ['public', 'private', 'investors_only'])->default('public');
            $table->integer('view_count')->default(0);
            $table->timestamps();
            $table->softDeletes();

            // Foreign keys
            $table->foreign('founder_id')->references('id')->on('users')->onDelete('cascade');

            // Indexes
            $table->index('founder_id');
            $table->index('stage');
            $table->index('industry');
            $table->index('is_verified');
            $table->index('is_hiring');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('startups');
    }
};
