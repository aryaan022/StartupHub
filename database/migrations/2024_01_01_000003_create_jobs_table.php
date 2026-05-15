<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('startup_id');
            $table->uuid('created_by_id');
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->text('requirements')->nullable();
            $table->text('benefits')->nullable();
            $table->enum('job_type', ['full_time', 'part_time', 'contract', 'internship']);
            $table->enum('experience_level', ['entry', 'junior', 'mid', 'senior'])->nullable();
            $table->decimal('salary_min', 10, 2)->nullable();
            $table->decimal('salary_max', 10, 2)->nullable();
            $table->string('salary_currency', 3)->default('USD');
            $table->string('location')->nullable();
            $table->enum('remote_type', ['remote', 'hybrid', 'onsite'])->nullable();
            $table->json('skills_required')->nullable();
            $table->integer('applications_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->timestamp('closed_at')->nullable();
            $table->softDeletes();

            // Foreign keys
            $table->foreign('startup_id')->references('id')->on('startups')->onDelete('cascade');
            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('cascade');

            // Indexes
            $table->index('startup_id');
            $table->index('is_active');
            $table->index('job_type');
            $table->index('experience_level');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
