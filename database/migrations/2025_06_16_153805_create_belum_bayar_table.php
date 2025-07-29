<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('belum_bayar', function (Blueprint $table) {
            $table->id(); // atau $table->integer('id', true) untuk sama persis dengan gambar

            $table->string('email', 50);
            $table->integer('status');
            $table->timestamp('created_at')->useCurrent();

            // Solusi 1: Gunakan nullable tanpa default value
            $table->timestamp('updated_at')->nullable();

            // Atau Solusi 2: Gunakan datetime jika ingin format khusus
            // $table->dateTime('updated_at')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('belum_bayar');
    }
};
