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
            $table->id();
            $table->foreignId('vendor_id')->constrained()->onDelete('cascade');
            $table->enum('product_type', ['car', 'car part']);
            $table->string('brand');
            $table->string('model')->unique();
            $table->year('production_year');
            $table->enum('status', ['available', 'sold']);
            $table->enum('state',['brand new', 'fairly used']);
            $table->string('pic');
            $table->string('price(FCFA)');
            $table->timestamps();
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
