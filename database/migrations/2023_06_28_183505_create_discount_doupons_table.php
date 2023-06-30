<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('discount_doupons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('locator');
            $table->decimal('discount', 10, 2);
            $table->decimal('limit', 10, 2);
            $table->date('expiration_date');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('discount_doupons');
    }
};
