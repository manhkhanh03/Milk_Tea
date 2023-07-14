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
            $table->string('name', 120);
            $table->unsignedBigInteger('vendor_id');
            $table->longText('url_video')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('limit_product')->default(false);
            $table->boolean('sold_out')->default(false);
            $table->boolean('approved')->default(false);
            $table->timestamps();

            $table->foreign('vendor_id')->references('id')->on('users');
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
