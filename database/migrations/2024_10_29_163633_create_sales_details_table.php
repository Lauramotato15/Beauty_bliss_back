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
        Schema::create('sales_details', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->float('total_value'); 
            $table->unsignedBigInteger('id_product'); 
            $table->unsignedBigInteger('id_sale');
            $table->foreign('id_product')->references('id')->on('products');
            $table->foreign('id_sale')->references('id')->on('sales');
            $table->softDeletes(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_details');
    }
};
