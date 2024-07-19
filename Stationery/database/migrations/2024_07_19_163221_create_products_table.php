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
            $table->uuid('id')->primary();
            $table->string('image_url')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 15, 2)->default(0.0);
            $table->decimal('stock_quantity', 15, 2)->default(0.0);
            $table->timestampTz('created_at');
            $table->timestampTz('updated_at');
            $table->uuid('categorie_id');
            $table->uuid('state_id');
            $table->uuid('supplier_id');

            $table->foreign('categorie_id')->references('id')->on('categories');
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
