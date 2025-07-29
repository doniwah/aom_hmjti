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
        Schema::create('price_changes', function (Blueprint $table) {
            $table->string('id_change', 3)->primary(); // Primary key dengan varchar(3)
            $table->integer('idTicket');
            $table->integer('old_price');
            $table->integer('new_price');
            $table->string('id_users', 3);
            $table->timestamp('created_at')->useCurrent();

            // // Jika perlu foreign keys:
            // $table->foreign('idTicket')->references('idTicket')->on('ticket');
            // $table->foreign('id_users')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('price_changes');
    }
};
