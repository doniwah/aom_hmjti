<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('offlinetransaction', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap', 40);
            $table->string('email', 50);
            $table->string('nama_ticket', 15);
            $table->string('kode_barcode', 10)->unique();
            $table->enum('status', ['belum', 'sudah']);
            $table->string('tempat_penjualan', 150)->nullable();
            $table->integer('presence');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offlinetransaction');
    }
};
