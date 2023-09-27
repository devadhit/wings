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
        Schema::create('transaction_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->decimal('sub_total',10,2);
            $table->string('document_code',3);
            $table->string('product_code',18);
            $table->timestamps();

            $table->foreign('document_code')->references('document_code')->on('transaction_header');
            $table->foreign('product_code')->references('product_code')->on('product');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_detail');
    }
};
