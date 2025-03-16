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
        // 2024_11_03_000003_create_orders_table.php
        Schema::create("orders", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id"); // Assume a user model or use a foreign key if users table exists
            $table->decimal("total_price", 8, 2);
            $table->string("status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("orders");
    }
};
