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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_size_flavor_id');
            $table->bigInteger('quantity')->default(1);
            $table->decimal('total', 20, 2)->default(0);
            $table->text('shipping_address');
            $table->timestamps();

            $table->foreign('product_size_flavor_id')->references('id')->on('product_size_flavors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
