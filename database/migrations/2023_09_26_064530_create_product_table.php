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
        Schema::create('product', function (Blueprint $table) {
            // $table->id();
            $table->string('product_code',18)->primary();
            $table->string('product_name',20);
            $table->string('product_image',255);
            $table->decimal('price',6,2);
            $table->string('currency',5);
            $table->decimal('discount',6,2);
            $table->string('dimension',50);
            $table->string('unit',5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
