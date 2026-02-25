<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            // храним относительный путь, например: products/philadelphia.jpg
            $table->string('path', 500);

            // порядок в галерее
            $table->unsignedInteger('sort')->default(100);

            // признак главной картинки
            $table->boolean('is_main')->default(false);

            // опционально: alt-текст
            $table->string('alt')->nullable();

            $table->timestamps();

            $table->index(['product_id', 'sort']);
            $table->index(['product_id', 'is_main']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
