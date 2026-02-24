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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('type', 32); // set | roll | snack | combo | wok | pizza ...
            $table->string('name');
            $table->string('slug')->unique();

            $table->text('description')->nullable();
            $table->text('composition')->nullable(); // состав / ингредиенты (единый источник)

            $table->unsignedInteger('weight_grams')->nullable();
            $table->unsignedInteger('pieces')->nullable();

            $table->decimal('price', 10, 2)->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index(['type', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
