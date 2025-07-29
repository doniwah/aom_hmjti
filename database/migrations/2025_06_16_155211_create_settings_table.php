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
        Schema::create('nama_tabel', function (Blueprint $table) {
            $table->id(); // bigint(20) UNSIGNED auto-increment
            $table->longText('description');
            $table->date('opening_date');
            $table->date('closing_date');
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('nama_tabel');
    }
};
