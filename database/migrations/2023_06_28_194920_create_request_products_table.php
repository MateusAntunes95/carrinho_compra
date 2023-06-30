<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('request_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained('requests');
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('discount_doupon_id')->nullable()->constrained('discount_doupons');
            $table->decimal('value', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->enum('status', ['RE', 'PA', 'CA']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('request_products');
    }
};
