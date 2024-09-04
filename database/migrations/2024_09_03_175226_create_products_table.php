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
            $table->id(); // Primary key
            $table->string('product_name'); // Product name
            $table->text('description')->nullable(); // Detailed description (nullable)
            $table->decimal('price', 8, 2); // Price with precision and scale
            $table->integer('stock'); // Stock quantity
            $table->string('image')->nullable(); // Image path (nullable)
            $table->timestamps(); // Created at and updated at
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