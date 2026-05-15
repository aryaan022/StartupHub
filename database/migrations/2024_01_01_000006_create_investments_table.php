<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('investments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('startup_id');
            $table->uuid('investor_id');
            $table->decimal('amount', 15, 2);
            $table->string('currency', 3)->default('USD');
            $table->enum('investment_type', ['seed', 'angel', 'venture', 'grant', 'revenue_share']);
            $table->decimal('equity_percentage', 5, 2)->nullable();
            $table->enum('status', ['proposed', 'negotiating', 'completed', 'failed'])->default('proposed');
            $table->timestamp('invested_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('startup_id')->references('id')->on('startups')->onDelete('cascade');
            $table->foreign('investor_id')->references('id')->on('investors')->onDelete('cascade');

            // Indexes
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investments');
    }
};
