<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->uuid('id_transaction')->primary();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->string('no_telp', 13);
            $table->unsignedBigInteger('id_ticket');
            $table->string('payment_method', 30);
            $table->string('id_panitia', 20)->nullable();
            $table->integer('ticket_price');
            $table->integer('transaction_fee');
            $table->integer('voucher_discount');
            $table->integer('total_prices');
            $table->unsignedBigInteger('id_voucher')->nullable();
            $table->integer('presence')->default(0);
            $table->text('bukti_pembayaran')->nullable();
            $table->enum('status', ['unpaid', 'paid']);
            $table->integer('confirmation');
            $table->string('kode_barcode', 100)->nullable();
            $table->timestamp('created_at')->useCurrent()->useCurrentOnUpdate();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaction');
    }
};
