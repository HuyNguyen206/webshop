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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Order::class);
            $table->foreignIdFor(\App\Models\ProductVariant::class);
            $table->string('name');
            $table->string('description');
            $table->unsignedInteger('price')->default(0);
            $table->unsignedInteger('quantity')->default(0);
            $table->unsignedInteger('amount_discount')->default(0);
            $table->unsignedInteger('amount_tax')->default(0);
            $table->unsignedInteger('amount_subtotal')->default(0);
            $table->unsignedInteger('amount_total')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
