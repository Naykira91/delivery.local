<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('set_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('set_id')->constrained('products')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();

            $table->unsignedInteger('qty')->default(1);
            $table->unsignedInteger('sort')->default(100);

            $table->unique(['set_id', 'product_id']);
            $table->index(['set_id', 'sort']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('set_items');
    }
};
