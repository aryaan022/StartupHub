<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('watchlists', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('investor_id');
            $table->uuid('startup_id');
            $table->timestamp('added_at');
            $table->text('notes')->nullable();

            // Foreign keys
            $table->foreign('investor_id')->references('id')->on('investors')->onDelete('cascade');
            $table->foreign('startup_id')->references('id')->on('startups')->onDelete('cascade');

            // Unique constraint
            $table->unique(['investor_id', 'startup_id']);

            // Indexes
            $table->index('investor_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('watchlists');
    }
};
