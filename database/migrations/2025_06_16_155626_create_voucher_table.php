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
        Schema::create('voucher', function (Blueprint $table) {
            $table->integer('id_voucher', true); // int(11) auto-increment primary key
            $table->string('kode', 20); // varchar(20)
            $table->string('name', 255); // varchar(255)
            $table->integer('quantity'); // int(11)
            $table->integer('discount'); // int(11)
            $table->date('start_date'); // date
            $table->date('end_date'); // date
            $table->timestamp('created_at')->nullable(); // timestamp NULL

            // Jika ingin menambahkan updated_at
            // $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('voucher');
    }
};
