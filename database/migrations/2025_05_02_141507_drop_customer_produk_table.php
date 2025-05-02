<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('customer_produk');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('customer_produk', function ($table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customer')->onDelete('cascade');
            $table->foreignId('produk_id')->constrained('produk')->onDelete('cascade');
            $table->timestamps();
        });
    }
};
