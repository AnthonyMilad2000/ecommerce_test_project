<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 2024_11_03_000002_create_products_table.php
        Schema::create("products", function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("category_id")
                ->constrained()
                ->onDelete("cascade");
            $table->string("name");
            $table->decimal("price", 8, 2);
            $table->integer("stock"); // Product stock
            $table->text("description")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("products");
    }
};
