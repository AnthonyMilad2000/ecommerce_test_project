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
        Schema::create('product_images', function (Blueprint $table) { // Singular table name recommended
            $table->id();
            $table->string('image'); // Image file name
            $table->foreignId('product_id')
                  ->constrained('products') // Explicitly define the referenced table
                  ->onDelete('cascade'); // Delete images when the product is deleted
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
