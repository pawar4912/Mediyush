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
        Schema::table('product_orders', function (Blueprint $table) {
            $table->dropColumn('products');
            $table->integer('product_id');
            $table->integer('product_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_orders', function (Blueprint $table) {
            $table->json('products');
            $table->dropColumn('product_id');
            $table->dropColumn('product_price');
        });
    }
};
