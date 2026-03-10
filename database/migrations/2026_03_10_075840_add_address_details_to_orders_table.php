<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('apartment', 50)->nullable()->after('address');
            $table->string('entrance', 50)->nullable()->after('apartment');
            $table->string('floor', 50)->nullable()->after('entrance');
            $table->string('intercom', 100)->nullable()->after('floor');
            $table->boolean('is_private_house')->default(false)->after('intercom');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'apartment',
                'entrance',
                'floor',
                'intercom',
                'is_private_house',
            ]);
        });
    }
};
