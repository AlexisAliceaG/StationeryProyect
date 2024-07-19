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
        Schema::create('details_receipts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->decimal('quantity', 15, 2)->default(0.0);
            $table->decimal('unit_price', 15, 2)->default(0.0);
            $table->decimal('subtotal', 15, 2)->default(0.0);
            $table->timestampTz('created_at');
            $table->uuid('product_id');
            $table->uuid('receipt_id');

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('receipt_id')->references('id')->on('receipts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details_receipts');
    }
};
