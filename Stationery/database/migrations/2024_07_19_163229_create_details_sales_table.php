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
        Schema::create('details_sales', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->decimal('quantity', 15, 2)->default(0.0);
            $table->decimal('unit_price', 15, 2)->default(0.0);
            $table->decimal('subtotal', 15, 2)->default(0.0);
            $table->timestampsTz();
            $table->uuid('sales_id');
            $table->uuid('product_id');

            $table->foreign('sales_id')->references('id')->on('sales')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details_sales');
    }
};
