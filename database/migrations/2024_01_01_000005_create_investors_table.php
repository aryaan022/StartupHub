<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('investors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->unique();
            $table->string('company_name')->nullable();
            $table->text('company_logo_url')->nullable();
            $table->text('company_description')->nullable();
            $table->decimal('investment_range_min', 15, 2)->nullable();
            $table->decimal('investment_range_max', 15, 2)->nullable();
            $table->json('industries')->nullable();
            $table->json('stages')->nullable();
            $table->json('countries')->nullable();
            $table->integer('portfolio_size')->nullable();
            $table->decimal('total_invested', 15, 2)->default(0);
            $table->string('website_url')->nullable();
            $table->boolean('verified')->default(false);
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Indexes
            $table->index('verified');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investors');
    }
};
