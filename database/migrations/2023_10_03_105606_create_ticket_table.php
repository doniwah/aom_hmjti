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
        Schema::create('ticket', function (Blueprint $table) {
            $table->id('idTicket'); // ganti dari default 'id' jadi 'idTicket'
            $table->string('name', 255);
            $table->string('sales_in', 30)->nullable();
            $table->integer('price');
            $table->integer('quantity');
            $table->unsignedInteger('limitPurchasing');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket');
    }
};
