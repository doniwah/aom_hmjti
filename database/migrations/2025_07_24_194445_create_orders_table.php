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
            $table->string('order_id', 50)->primary()->default('0');
            $table->string('name', 255);
            $table->string('phone', 255);
            $table->bigInteger('total_price');
            $table->string('status', 50);
            $table->string('snap_token', 50)->nullable();
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('barcode')->nullable()->unique();
            $table->boolean('barcode_used')->default(false);
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
