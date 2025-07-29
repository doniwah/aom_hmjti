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
        Schema::create('ticket_benefit', function (Blueprint $table) {
            $table->integer('id_ticket_benefits', true); // int(11) auto-increment
            $table->string('name', 50); // varchar(50)
            $table->integer('id_ticket'); // int(11)

            // Jika ingin menambahkan timestamps
            // $table->timestamps();

            // Jika ingin menambahkan foreign key
            // $table->foreign('id_ticket')->references('id')->on('tickets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('ticket_benefit');
    }
};
